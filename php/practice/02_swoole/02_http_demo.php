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
        $this->http = new swoole_http_server($host, $port);
    }

    /**
     * @return $this
     */
    public function bind()
    {
        $this->http->on('request', function ($request, $response) {
            var_dump($request->port);
            var_dump($response->port);

            $response->header('Content-Type', "text/html", "charset=utf-8");
            $response->end('<h1>Hello Swoole. #' . rand(1000, 9999) . "</h1>");
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