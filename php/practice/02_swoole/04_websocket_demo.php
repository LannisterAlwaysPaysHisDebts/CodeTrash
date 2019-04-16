<?php
/**
 * ws服务端
 *
 *
 */

class wsServer
{
    protected $ws;

    public function __construct($host = '0.0.0.0', $port = 9502)
    {
        $this->ws = new swoole_websocket_server($host, $port);

        $this->ws->set([
            'worker_num' => 2,
            'task_worker_num' => 2
        ]);

        $this->ws->on('open', [$this, 'open']);
        $this->ws->on('message', [$this, 'message']);
        $this->ws->on('task', [$this, 'task']);
        $this->ws->on('finish', [$this, 'onFinish']);
        $this->ws->on('close', [$this, 'onClose']);
    }

    public function open($ws, $request)
    {
        var_dump($request->fd, $request->get, $request->server);

        if ($request->fd == 1) {
            swoole_timer_tick(2000, function ($timerId) {
                echo "2s: timerId: {$timerId} \n";
            });
        }

//        $ws->push($request->fd, "hello! welcome to my club");
    }

    /**
     *
     *
     * @param $ws swoole_websocket_server
     * @param $frame
     */
    public function message($ws, $frame)
    {
        echo "serverMessage {$frame->data}" . PHP_EOL;

        $data = [
            'task' => 1,
            'fd' => $frame->fd
        ];

        $ws->task($data);
        swoole_timer_after(5000, function () use ($ws, $frame) {
            echo "5s-after " . PHP_EOL;
            $ws->push($frame->fd, "server-");
        });
        $ws->push($frame->fd, "server-push: " . date('Y-m-d'));

//        echo "Message: {$frame->data}\n";
//        $ws->push($frame->ws, "server: {$frame->data}");
    }

    public function onTask($serv, $taskId, $workerId, $data)
    {
        print_r($data);
        // 耗时10s
        sleep(10);

        return 'on task finish'; // 告诉worker
    }

    /**
     * @param $serv
     * @param $taskId
     * @param $data: 内容是onTask返回的内容
     */
    public function onFinish($serv, $taskId, $data)
    {
        echo "taskId: {$taskId} \n";
        echo "finish data success: {$data} \n";
    }

    /**
     * close
     * @param $ws
     * @param $fd
     */
    public function onClose($ws, $fd)
    {
        echo "client id: {$fd} \n";
    }

    public function start()
    {
        $this->ws->start();
    }
}

$obj = new wsServer();
$obj->start();