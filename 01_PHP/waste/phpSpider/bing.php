<?php
$url = 'https://cn.bing.com/HPImageArchive.aspx?format=js&idx=0&n=1&pid=hp';
$baseUrl = 'https://cn.bing.com';

$setOption = [
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => 1
];

$ch = curl_init();
curl_setopt_array($ch, $setOption);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);

if (empty($data)) {
    exit('获取失败');
}

$data = json_decode($data, true);
$imageUrl = $baseUrl . $data['images'][0]['url'];
$imageName = $data['images'][0]['copyright'];
$length = strpos($imageName, '(');
$imageName = substr($imageName, 0, $length);
$path = __DIR__ . 'bing.php/' . trim($imageName) . date('Ymd') . '.jpg';

if (copy($imageUrl, $path)) {
    exit('下载成功');
}
exit('获取失败');

