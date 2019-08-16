<?php
/**
 * 获取必应的每日壁纸, 最多获取前15天
 */
$imageUrl = 'https://cn.bing.com/HPImageArchive.aspx?format=js&idx=%s&n=1&pid=hp';   //%s 和现在相距的天数
$baseUrl = 'https://cn.bing.com';

$setOption = [
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => 1
];

$mh = curl_multi_init();
$curlArray = [];
for ($i = 0; $i <= 15; $i++) {
    $ch = curl_init();
    curl_setopt_array($ch, $setOption);
    $url = sprintf($imageUrl, $i);
    curl_setopt($ch, CURLOPT_URL, $url);
    $curlArray[$i] = $ch;
    curl_multi_add_handle($mh, $curlArray[$i]);
}

$running = NULL;
do {
    usleep(10000);
    curl_multi_exec($mh, $running);
} while ($running > 0);

$data = [];

for ($i = 0; $i <= 15; $i++) {
    $data[$i] = curl_multi_getcontent($curlArray[$i]);
    curl_multi_remove_handle($mh, $curlArray[$i]);
}
curl_multi_close($mh);

foreach ($data as $item) {
    $item = json_decode($item, true);
    $imageUrl = $baseUrl . $item['images'][0]['url'];
    
    $imageName = $item['images'][0]['copyright'];
    $length = strpos($imageName, '(');
    $imageName = substr($imageName, 0, $length);
    $path = dirname(__DIR__) . '/catch/food/' . trim($imageName) . '.jpg';
    copy($imageUrl, $path);
}

exit('获取图片完成');






