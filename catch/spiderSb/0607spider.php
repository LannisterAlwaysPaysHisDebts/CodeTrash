<?php
/**
 * 汉字纠错题库解释遍历
 */

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

$baseUrl = 'http://www.100bt.com/chengyu/chaxun/';

$rule = [
    'url' => ['.idiomsList div', 'html'],
    // 'titile' => ['.idiomsList div', 'text']
];

$data = require dirname(__DIR__) . '/hzjc_v4.cfg.php';

foreach ($data as $item) {
    foreach ($item as $value) {
        $url = $baseUrl . $value['Right'];
        
        $data = \QL\QueryList::get($url)->rules($rule)->query()->getData();
        var_dump($data->all());
        die();
    }
}