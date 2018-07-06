<?php

require dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';

$imageDir = __DIR__ . '/data/image/';

$errorPath = __DIR__ . '/data/error.txt';

$questionPath = __DIR__ . '/data/config.php';

//lv = 等级
$url = 'api.luoxue.com/app/index.php?i=6&t=0&v=1.01&from=wxapp&c=entry&a=wxapp&do=getlvitem&state=we7sid-9e4823f69b286c659014cffb508a059b&sign=6cc486128a927704892e0923e1a89601&m=guess&lv=';

//生龙活虎&&&15d2d8bb45641d6d7f5016f910f69dba.png&&&形容很有生气和活力。',
$question = [];

$ch = curl_init();
for ($l = 1; $l < 100; $l++) {
    $new_url = $url . $l;
    curl_setopt($ch, CURLOPT_URL, $new_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);

    if (!empty($data)) {
        $data = json_decode($data, true);

        if (!empty($data['data'])) {
            foreach ($data['data'] as $item) {
                $array = [
                    'question' => trim($item['answer']),
                    'img' => md5($item['answer']) . '.png',
                    'explain' => trim($item['explain'])
                ];
                $img = $imageDir . md5($item['answer']) . '.png';
                if (!file_exists($img)) {
                    if(!copy($item['pic'], $img)) {
                        $error = '下载图片失败: 图片地址: ' . $item['pic'] . "\t\n";
                        file_put_contents($errorPath, $error, FILE_APPEND);
                    }
                }
                $question[] = implode('&&&', $array);
            }
        }
    }

}
curl_close($ch);

if (!empty($question)) {
    $tpl = "<?php
return ";
    file_put_contents($questionPath, $tpl);

    $question = var_export($question, true) . ';';
    file_put_contents($questionPath, $question, FILE_APPEND);
}

die();