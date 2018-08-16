<?php
/**
 * 生成器
 */

function gen_one_to_three(){
    for ($i = 1; $i <= 3; $i++) {
        yield $i;
    }
}

$generator = gen_one_to_three();

// var_dump 给的是一个空对象
var_dump($generator);

// 打印出1, 2, 3
foreach ($generator as $value) {
    echo "$value\n";
}


