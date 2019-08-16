<?php
/**
 * 使用yield生成器
 *
 * 特点是只有在foreach 的时候会生成数据,在循环的时候如果数据变化则是输出的变化之后的数据
 *
 *
 * 使用场景:
 * 1. 读取超大文件,不用一次性将文件内容赋给某个变量,而是逐行输出
 *
 */


// 输出的是变化之后的数据, 这里的time是输出时才生成的
// 例子1:
function theTime($times = 10)
{
    for ($i = 0; $i < $times; $i++) {
        yield "当前时间: " . time();
    }
}

// 例子1测试代码
foreach (theTime() as $key => $value) {
    var_dump("$key => $value");
    sleep(1);
}


// 使用场景1. 读取大文件
/**
 * @return Generator
 */
function getItem()
{
    $file = __DIR__ . '/data.php';

    if($handle = fopen($file, 'r+')) {
        while (feof($handle) == false) {
            yield fgets($handle);
        }

        fclose($handle);
    }
}

// 场景1.测试
//foreach (getItem() as $key => $value) {
//    var_dump("$key => $value");
//}