<?php
/**
 * 谜语大全采集单项字谜
 */

require dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';
require dirname(dirname(dirname(__DIR__))) . '/lib/Proxy.class.php';

$_header = '
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8
Accept-Language: zh-CN,zh;q=0.9,en;q=0.8,es;q=0.7,zh-TW;q=0.6
Cache-Control: no-cache
Connection: keep-alive
Host: m.t086.com
Pragma: no-cache
Referer: http://m.t086.com/chengyu/11491
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Mobile Safari/537.36
';

$content_rule = [
    'title' => ['.art_Tit', 'text'],
    'content' => ['.topic_Box dd', 'text']
];

$list = require __DIR__ . '/data/caizimi/list.php';

$data_path = __DIR__ . '/data/caizimi/data.php';

$error_path = __DIR__ . '/data/caizimi/error.php';

$data = [];
$error = [];
if (!file_exists($data_path)) {
    $tpl = "<?php
return array();";
    file_put_contents($data_path, $tpl);
} else {
    $data = require __DIR__ . '/data/caizimi/data.php';
}

if (!file_exists($error_path)) {
    $tpl = "<?php
return array();";
    file_put_contents($error_path, $tpl);
} else {
    $error = require __DIR__ . '/data/caizimi/error.php';
}

$opt = [
    // 设置http代理
    'proxy' => 'http://121.16.204.179:8118',
    //设置超时时间，单位：秒
    'timeout' => 30,
];

//$a = \QL\QueryList::get('http://m.baidu.com', '', $opt)->getHtml();
//var_dump($a);
//
//die();

foreach ($list as $key => $value) {

    $html = \lib\Proxy::get($value, $_header);

    $getData = \QL\QueryList::html($html)->rules($content_rule)->query()->getData();
    $array = $getData->all();

    $title = $array[0]['title'];
    $answer = $array[1]['content'];
    $explain = $array[0]['content'];

    if (empty($title) || empty($answer) || empty($explain)) {
        var_dump("第 $key 项没有获取到内容");

        $error[$key] = $key;
        file_put($error, $error_path);
        sleep(1);

    } else {
//字谜格式: '打一字&三个日&晶&小贴士：三个日合在一起就是晶了呀',
        $question = [
            '打一字',
            $title,
            $answer,
            $explain
        ];
        $question = implode('&', $question);
        if (!in_array($question, $data)) {
            var_dump("采集成功 $answer");

            $data[] = $question;
            file_put($data, $data_path);
            sleep(1);
        }

    }
}


function file_put($data, $path)
{
    if (file_exists($path)) {
        unlink($path);
    }

    $tpl = "<?php
return " . var_export($data, true) . ';';
    file_put_contents($path, $tpl);

}