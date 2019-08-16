<?php
/**
 * swoole tcp客户端与服务端demo
 *
 *
 *
 *
 */


class TCPServer
{
    /**
     * @var swoole_server
     */
    protected $server;

    /**
     * 初始化对象, 默认地址与端口
     *
     * @param string $host
     * @param int $port
     * @return $this
     */
    public function init($host = '127.0.0.1', $port = 9501)
    {
        //创建Server对象，监听 127.0.0.1:9501端口
        $this->server = new swoole_server($host, $port);

        $this->server->set([
            'worker_num' => 8, // worker 进程数, 建议设置为cpu核数的1-4倍
            'max_request' => 10000,
        ]);

        return $this;
    }

    /**
     * 绑定连接事件出现时, 执行的函数
     *
     * @return $this
     */
    public function bindConnect()
    {
        /**
         * 疑问:
         * callback函数如何在类里面调一个自定义函数, 比如这里的callback第一个第二个参数都是固定要传的
         */

        //监听连接进入事件
        // $fd 是客户端连接的唯一标示
        // $reactor_id 线程id
        $this->server->on('connect', function ($serv, $fd, $reactor_id) {
            echo "Client: {$reactor_id} - {$fd} " . PHP_EOL;
        });
        return $this;
    }

    /**
     * 绑定消息到达事件出现时, 执行的函数
     *
     * @return $this
     */
    public function bindReceive()
    {
        $this->server->on('receive', function ($serv, $fd, $from_id, $data) {
            $serv->send($fd, "Server: " . $data);
        });
        return $this;
    }

    /**
     * 绑定断开连接事件出现时, 执行的函数
     *
     * @return $this
     */
    public function bindClose()
    {
        $this->server->on('close', function ($serv, $fd) {
            echo "Client: Close@ " . PHP_EOL;
        });
        return $this;
    }

    /**
     *
     */
    public function start()
    {
        $this->server->start();
    }

    /**
     * @param $serv
     * @param $fd
     */
    function connect($serv, $fd)
    {
        echo "Client: Connect " . PHP_EOL;
    }

    /**
     * @param $serv
     * @param $fd
     * @param $from_id
     * @param $data
     */
    function receive($serv, $fd, $from_id, $data)
    {
        $this->server->send($fd, "Server: " . $data);
    }

    /**
     * @param $serv
     * @param $fd
     */
    function close($serv, $fd)
    {
        echo "Client: Close@ " . PHP_EOL;
    }
}

/**
 * Class TCPClient
 */
class TCPClient
{
    /**
     * @var swoole_client
     */
    private $client;

    /**
     * TCPClient constructor.
     */
    public function __construct()
    {
        $this->client = new swoole_client(SWOOLE_SOCK_TCP);
    }

    /**
     *
     */
    public function connect()
    {
        if (!$this->client->connect("127.0.0.1", 9501, 1)) {
            echo "连接失败 Error: {$this->client->errMsg}[{$this->client->errCode}]\n";
            exit();
        }

        fwrite(STDOUT, "请输入消息 Please input msg：");
        $msg = trim(fgets(STDIN));
        $this->client->send($msg);

        $message = $this->client->recv();
        echo "Get Message From Server:{$message}\n";
    }
}

$choose = $argv[1];

if ($choose == 'client') {
    $obj = new TCPClient();
    $obj->connect();
} else {
    $obj = new TCPServer();
    $obj->init()->bindConnect()->bindReceive()->bindClose()->start();
}


