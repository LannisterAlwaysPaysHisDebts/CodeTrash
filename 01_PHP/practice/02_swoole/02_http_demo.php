<?php
/**
 * 创建http服务器
 *
 * 这里是nginx转发给swoole的http服务器
 *
 *
 *
 *
 */

class HttpServer
{
    /**
     * @var swoole_http_server
     */
    protected $http;

    /**
     * HttpServer constructor.
     * @param string $host
     * @param int $port
     */
    public function __construct($host = '0.0.0.0', $port = 9501)
    {
        // 0.0.0.0 表示监听所有,无论是外网地址还是内网地址还是本机地址
        $this->http = new swoole_http_server($host, $port);

        $this->http->set([
            'enable_static_handler' => true,
            'document_root' => '/Users/caoting/notes/myNotes/php/swoole/demo/server/'
        ]);
    }

    /**
     * @return $this
     */
    public function bind()
    {
        $this->http->on('request', function ($request, $response) {
            $response->cookie("caoting", "xsssss", time() + 20);
            $response->header('Content-Type', "text/html", "charset=utf-8");
            $str = "<h1>HTTP Server</h1><h2>Get: " . json_encode($request->get) . "</h2>";
            $response->end($str);
        });

        return $this;
    }

    /**
     *
     */
    public function start()
    {
        $this->http->start();
    }
}

$obj = new HttpServer();
$obj->bind()->start();