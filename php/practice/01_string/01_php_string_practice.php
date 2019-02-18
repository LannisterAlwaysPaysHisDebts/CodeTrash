<?php
/**
 * 字符串处理练习, 只使用字符串操作函数, 将data.php中字符串的内容提取分块
 *
 */

$data = require __DIR__ . '/data.php';


$chapterStart = strpos($data, '<div class="course-chapters">');
$chapterFinder = substr($data, $chapterStart);

$a = findTag('div', $chapterFinder);
var_dump($a);



/**
 * 寻找第一个tag开头
 * 寻找第二个tag开头
 * 寻找...个tag开头
 *
 * 没有了之后
 *
 * 寻找第一个tag结尾
 * 寻找第二个tag结尾
 * 寻找对应的tag结尾
 *
 * @param $tag
 * @param $data
 *
 * @return bool
 */
function findTag($tag, $data)
{
    $startTag = "<" . strtolower($tag);
    $endTag = "</" . strtolower($tag) . '>';

    $start = strpos($data, $startTag);
    if ($start === false) {
        return false;
    }

    $end = strpos($data, $endTag);
    if ($end === false) {
        return false;
    }

//    do{
//        strpos($startTag, );

//    }while(1);


}
