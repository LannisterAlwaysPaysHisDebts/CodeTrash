<?php
// 0.0.0.0 表示监听所有
$http = new swoole_http_server("0.0.0.0", 8811);

$http->set([
    'enable_static_handler' => true,
    'document_root' => '/Users/caoting/notes/myNotes/php/swoole/demo/server/'
]);

$http->on('request', function($request, $response){
    $response->cookie("caoting", "xsssss", time() + 20);
    $str = "<h1>HTTP Server</h1><h2>Get: " . json_encode($request->get) . "</h2>";
    $response->end($str);
});

$http->start();

