<?php
/**
 * 成语接龙
 */
require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

function convToUtf8($str) {
    if( mb_detect_encoding($str,"UTF-8, ISO-8859-1, GBK")!="UTF-8" ) {
        return  iconv("gbk","utf-8",$str);
    } else {
        return $str;
    }
}

//$baseUrl = 'chengyu.t086.com/ajax_jielong.php';
//
//$params = [
//    'cy' => '为所欲为',
//    'cm' => 10,
//    'cn' => 1,
//    'cf' => 0,
//    'ct' => 1,
//    'cmode' => 0
//];
//
//$rules = [
//    'question' => ['#copy_content a', 'text'],
//    'url' => ['#copy_content a', 'href'],
//];
//
//$ql = \QL\QueryList::post($baseUrl, $params)->encoding('UTF-8');
//$data = $ql->rules($rules)->query()->getData();
//$output = $data->all();
//foreach ($output as $key => $item) {
//    if ($item['question'] == '→') {
//        unset($output[$key]);
//    }
//}
//array_merge($output);
//var_dump($output);





//****抓取最长的龙

$baseUrl = 'chengyu.t086.com/jielong/zuichang.html';

$rules = [
    'Question' => ['#hx_content a', 'text'],
    'Url' => ['#hx_content a', 'href']
];

$html = \QL\QueryList::get($baseUrl)->encoding('UTF-8')->getHtml();

$ql = \QL\QueryList::getInstance();
$data = $ql->html($html)->rules($rules)->query();



















