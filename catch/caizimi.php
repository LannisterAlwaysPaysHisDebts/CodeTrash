<?php
//疯狂猜字谜采集脚本
/**
 * 可优化: 
 * 1.每采集一次或者一页题目写一次缓存, 不要一次性写进去
 * 2.应当有容错, 在采集时如果采集失败要重复采集
 * 3.要有自动断点继续的功能
 * 4.采集+过滤
 */
require dirname(__DIR__) . '/vendor/autoload.php';


//转换成为utf8
function convToUtf8($str) {
    if( mb_detect_encoding($str,"UTF-8, ISO-8859-1, GBK")!="UTF-8" ) {
        return  iconv("gbk","utf-8",$str);
    } else {
        return $str;
    }
}

$urlHead = 'http://www.cmiyu.com/zmmy/';
$page = 'my131.html';

$long1 = strlen('谜面：');
$long2 = strlen('谜底：');

//列表采集规则
$rules = [
    'url' => ['.list ul li a', 'href'],
    'nextPage' => ['.sy3 a', 'href'],
    'nextPageText' => ['.sy3 a', 'text']
];

//题目采集规则
$questionRules = [
    'text' => ['.md h3', 'text'],
    'tip' => ['.zy p', 'text']
];

//遍历列表采集, 自动翻页
$questionList = [];
do {
    //拿到每题的地址
    $wholeUrl = $urlHead . $page;
    $data = QueryList::Query($wholeUrl, $rules)->data;
    if (empty($data)) {
        die('获取list失败');
    }
    //循环拿到每页的题目
    $liHtml = [];
    $nextPageList = [];
    $nextPage = '';
    $tip = '';
    foreach ($data as $item) {
        if (isset($item['nextPage']) && isset($item['nextPageText'])) {
            $liHtml[] = convToUtf8($item['nextPageText']);
            $nextPageList[] = convToUtf8($item['nextPage']);
            foreach ($liHtml as $key => $childLiHtml) {
                if ($childLiHtml == '下一页') {
                    $nextPage = $nextPageList[$key];
                }
            }
        }
        $questionUrl = $pageHead . $item['url'];
        $text = QueryList::Query($questionUrl, $questionRules)->data;
        //转换格式, 拼接题目
        foreach ($text as $key => $value) {
            if (isset($value['tip'])) {
                $tip = convToUtf8($value['tip']);
            }
            $utf8Text = convToUtf8($value['text']);

            $text[$key] = substr($utf8Text, $long1);
        }
        $questionList[] = [
            'Question' => $text[0],
            'Answer' => $text[1],
            'Tip' => $tip
        ];
    }

    if (!empty($nextPage)) {
        $page = $nextPage;
    } else {
        break;
    }
} while (!empty($nextPage));

//写入配置文件
$filePath = dirname(__DIR__) . '/test/new_czm.php';
$newArray = var_export($questionList, true);
file_put_contents($filePath, $newArray, FILE_APPEND);

//****猜字谜采集ENd