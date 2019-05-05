<?php
/**
 *
 * 多进程curl下载网页
 *
 *
 *
 *
 */

echo "process start: " . date('Y-m-d H:i:s') . PHP_EOL;

$workers = [];
$urls = [
    'https://www.runoob.com/html/html-tutorial.html',
    'https://www.runoob.com/html/html5-intro.html',
    'https://www.runoob.com/js/js-tutorial.html',
    'https://www.runoob.com/linux/linux-tutorial.html',
    'https://www.runoob.com/php/php-tutorial.html',
    'https://www.runoob.com/python/python-tutorial.html',
    'https://www.runoob.com/cprogramming/c-tutorial.html',
    'https://www.runoob.com/django/django-tutorial.html',
    'https://www.runoob.com/lua/lua-tutorial.html',
    'https://www.runoob.com/regexp/regexp-tutorial.html'
];

for ($i = 0; $i < count($urls); $i++) {
    $url = $urls[$i];
    $process = new swoole_process(function (swoole_process $worker) use ($url) {
        // curl

//        $content = file_get_contents($urls[$i]);
        $content = curlData($url);
        $worker->write($content); // 写入管道

    }, true);

    $pid = $process->start();
    $workers[$pid] = $process;
}

foreach ($workers as $pid => $childProcess) {
    echo $childProcess->read();
}

echo "process end: " . date('Y-m-d H:i:s') . PHP_EOL;

/**
 * curl demo
 *
 * @param $url
 * @return string
 */
function curlData($url)
{
    sleep(rand(3, 5));
    return "{$url}  get SUCCESS" . PHP_EOL;

    $ch = curl_init($url);
    $data = curl_exec($ch);
    curl_close();

    return $data . PHP_EOL;
}
