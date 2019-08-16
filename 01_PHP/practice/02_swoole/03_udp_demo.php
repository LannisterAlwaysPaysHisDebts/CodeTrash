<?php
/**
 * udp服务器, 客户端 demo
 *
 *
 *
 */


class UDPServer
{
    protected $server;

    public function __construct($host = '127.0.0.1', $port = 9502)
    {

        $this->server = new swoole_server($host, $port, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

    }

    public function start()
    {
        $this->server->on('Packet', function ($serv, $data, $clientInfo){
            $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server: " . $data);
            var_dump($data);
            var_dump($clientInfo);
        });

        $this->server->start();
    }
}

class UDPClient
{
    protected $client;

    public function __construct()
    {
        $this->client = new swoole_client(SWOOLE_SOCK_UDP);
    }

    public function send($ip = '127.0.0.1', $port = 9502)
    {
        fwrite(STDOUT, "输入消息: ");
        $msg = trim(fgets(STDIN));

        $this->client->sendto($ip, $port, $msg);

        $result = $this->client->recv();
        var_dump($result);
    }
}

$choose = $argv[1];

if ($choose == 'client') {
    $obj = new UDPClient();
    $obj->send();
} else {
    $obj = new UDPServer();
    $obj->start();
}
