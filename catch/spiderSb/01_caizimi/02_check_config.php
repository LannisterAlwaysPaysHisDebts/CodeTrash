<?php
/**
 * 筛选图片
 */


$config = require __DIR__ . '/data/new_config.php';

$imgPath = __DIR__ . '/data/image/';

$imgNewPath = __DIR__ . '/data/qccy_new_image/';

foreach ($config as $item) {
    $array = explode('&&&', $item);
    $img = $imgPath . $array[1];
    $newImg = $imgNewPath . $array[1];
    if (file_exists($img)) {
        if (!file_exists($newImg)) {
            if (!copy($img, $newImg)) {
                var_dump('copy图片失败: ' . $img);
            }
        }
    } else {
        var_dump('不存在图片: ' . $img);
    }
}


//检查完整性
foreach ($config as $item) {
    $array = explode('&&&', $item);
    $newImg = $imgNewPath . $array[1];

    if (!file_exists($newImg)) {
        var_dump('图片不存在');
    }
}

foreach ($config as $key => $item ) {
    $array = explode('&&&', $item);
    foreach ($config as $_key => $_item) {
        $_array = explode('&&&', $_item);
        if ($key != $_key && $array[1] == $_array[1]) {
            var_dump('有重复图片' . $array[0]);
            unset($config[$key]);
        }
    }
}

$config = array_merge($config);

$out = var_export($config, true) . ';';
$tpl = "<?php
return ";

file_put_contents(__DIR__ . '/data/final_config.php', $tpl . $out);