<?php

$file[] = require __DIR__ . '/data/gif.php';
$file[] = require __DIR__ . '/data/gif1.php';
$file[] = require __DIR__ . '/data/gif2.php';
$file[] = require __DIR__ . '/data/gif3.php';
$file[] = require __DIR__ . '/data/gif4.php';
$file[] = require __DIR__ . '/data/gif5.php';
$file[] = require __DIR__ . '/data/gif6.php';

$gifData = [];

foreach ($file as $item) {

    foreach ($item['Title'] as $key => $value) {
        $gifData[] = [
            'Title' => $item['Title'][$key],
            'Image' => $item['Image'][$key]
        ];


    }
}

var_dump('新增 ' . count($gifData) . ' 个gif');

$path = __DIR__ . '/data/lastGif.php';
$tpl = "<?php
return " . var_export($gifData, true) . ';';
file_put_contents($path, $tpl);