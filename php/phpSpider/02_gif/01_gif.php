<?php
require dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';


$url = 'http://hnbang.com/view/26697.html';

$rule = [
    'title' => ['.article-content p', 'text'],
    'image' => ['.article-content img', 'src']
];

$result = \QL\QueryList::get($url)->rules($rule)->query()->getData();

$data = $result->all();

$gif = [];
foreach ($data as $item) {
    if (!empty($item['title'])) {
        $gif['Title'][] = $item['title'];
    }
    if (!empty($item['image'])) {
        $gif['Image'][] = $item['image'];
    }
}

$path = __DIR__ . '/data/gif6.php';
$tpl = "<?php
return " . var_export($gif, true) . ';';

file_put_contents($path, $tpl);