<?php
/**
 * 在别人的博客上采集必应图片, 先拿到图片列表
 */

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

function getImageList()
{
    //采集地址
    $baseUrl = 'https://blog.mrabit.com/bing/%s';

    //采集规则
    $rules = [
        'date' => ['.bing_main div', 'data-description'],
        'title' => ['.bing_main div', 'data-title'],
    ];

    //食物保存地址
    $filePath = __DIR__ . '/food20180531.php';

    //文件不存在则生成
    if (!file_exists($filePath)) {
        $tpl = "<?php

";
        file_put_contents($filePath, $tpl);
    }

    for ($page = 1; $page <= 50; $page++) {
        $url = sprintf($baseUrl, $page);

        //采集数据
        $data = \QL\QueryList::get($url)->rules($rules)->query()->getData();
        $middleData = var_export($data->all(), true);

        //拼接成数组的形式
        $outputData = '$a' . $page . ' = ' . $middleData . ';';

        file_put_contents($filePath, $outputData, FILE_APPEND);
    }
}

function hasUpdateToday()
{
    $baseUrl = 'https://blog.mrabit.com/bing';//采集地址

    $today = date('Y-m-d');//日期

    //图片地址
    $imageBaseUrl640 = 'http://cdn.mrabit.com/480.%s.jpg';
    $imageBaseUrl1080 = 'http://cdn.mrabit.com/1920.%s.jpg';
    $imageBaseUrlPreview = 'http://cdn.mrabit.com/1920.%s.jpg-preview.50p';
    
    $rules = [
        'date' => ['.bing_main div', 'data-description'],
        'title' => ['.bing_main div', 'data-title'],
    ];

    $data = \QL\QueryList::get($baseUrl)->rules($rules)->query()->getData();
    $data = $data->all();
    if ($date[0]['date'] == $today) {   //当天已更新
        $title = $date[0]['title'];
        if (empty($title)) {
            return ['Code' => 201, 'Msg' => '标题为空'];
        }
        $imageUrl = sprintf($imageBaseUrl640, $today);
        $sql = "INSERT INTO image(Title, Date, ImageUrl) VALUES('{$title}', '{$today}', '{$imageUrl}')";
        
        $pdo = new PDO('mysql:host=localhost;dbname=weiliu_wechat_app_link', 'root', 'root');
        $stmt = $pdo->prepare($sql);
        $res = $stmt->execute();
        if (!$res) {
            return ['Code' => 201, 'Msg' => '插入失败'];
        }

    }
}

//1080p 图片地址
$imageBaseUrl1080 = 'http://cdn.mrabit.com/1920.%s.jpg';

//640*480 图片地址
$imageBaseUrl640 = 'http://cdn.mrabit.com/480.%s.jpg';

//预览地址
$imageBaseUrlPreview = 'http://cdn.mrabit.com/1920.%s.jpg-preview.50p';

//图片名称
$date = '2018-05-31';


$res = hasUpdateToday();
var_dump($res);