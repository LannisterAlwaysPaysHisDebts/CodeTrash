<?php
$imageBaseUrl640 = 'http://cdn.mrabit.com/480.%s.jpg';

$date = date('Y-m-d');
$url = sprintf($imageBaseUrl640, $date);

$header = get_headers($url);
$status = strpos($header[0], '200 OK');
if (!$status) {
    die('今天的图片还没有更新');
}

//图片存在
$baseUrl = 'https://blog.mrabit.com/bing';

$pdo = new PDO('mysql:host=localhost;dbname=weiliu_wechat_app_link', 'root','root');


die();
//*********以前的图片遍历出来
$data = include dirname(dirname(__DIR__)) . '/catch/spiderSb/food20180531.php';
foreach ($data as $a) {
    foreach ($a as $item) {
        try{
            $url = sprintf($imageBaseUrl640, $item['date']);
            $sql = "INSERT INTO Image(Title,ImageUrl,Date) VALUES('{$item['title']}','{$url}','{$item['date']}')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } catch(PDOException $e) {
            print "Error!   " . $e->getMessage() . '\n';
            die();
        }
        var_dump($item['date'] . '写入成功');
    }
}