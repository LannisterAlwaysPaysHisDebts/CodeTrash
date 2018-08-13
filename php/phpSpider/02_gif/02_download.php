<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2018/7/6
 * Time: 下午6:25
 */

$data = require __DIR__ . '/data/gif.php';


foreach ($data['Image'] as $key => $item) {
    $img = md5($data['Title'][$key]) . '.gif';
    $imgPath = __DIR__ . '/data/gif/' . $img;
    if(!copy($item, $imgPath)) {
        var_dump('失败: ' . $data['Title'][$key]);
    }
}