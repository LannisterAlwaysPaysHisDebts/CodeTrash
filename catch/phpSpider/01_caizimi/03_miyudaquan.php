<?php
/**
 * 谜语大全抓取: http://gs.jzb.com/my/
 */

require dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';

// url + page, 这里的 page 需要乘 20
$list_url = 'http://gs.jzb.com/my/?pg=';
$list_url = 'http://gs.jzb.com/my/a2566/?pg=';

// base_url + a href
$base_url = 'http://gs.jzb.com';

// 最大的页面: 100
$max_page = 100;

// 列表抓取规则
$list_rule = [
    'url' => ['.riddles_Lst h3 a', 'href']
];

//采集list

$data = [];
for ($i = 1; $i <= $max_page; $i++) {
    $list = $list_url . 20 * $i;

    $getData = \QL\QueryList::get($list)->rules($list_rule)->query()->getData();
    $array = $getData->all();

    if (!empty($array)) {
        foreach ($array as $item) {
            $data[] = $base_url . $item['url'];
        }
        var_dump('采集第 ' . $i . ' 页成功!');
        usleep(200000);
    }
}

$outPath = __DIR__ . '/data/caizimi/list.php';

$data = var_export($data, true) . ';';
$tpl = "<?php
return " . $data;

file_put_contents($outPath, $tpl);




 

 