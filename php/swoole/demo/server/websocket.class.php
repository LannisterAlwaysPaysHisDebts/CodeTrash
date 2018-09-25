<?php


/**
 * Class webSocket
 */
class webSocket
{
    CONST HOST = '0.0.0.0';

    CONST PORT = 9502;

    private $server = null;

    public function __construct()
    {
        $this->server = new swoole_websocket_server('0.0.0.0', 9502);

        $this->server->set([
            'worker_num' => 2,
            'task_worker_num' => 2
        ]);

        $this->server->on("open", [$this, 'onOpen']);
        $this->server->on('message', [$this, 'onMessage']);
        $this->server->on('task', [$this, 'onTask']);
        $this->server->on('finish', [$this, 'onFinish']);
        $this->server->on('onclose', [$this, 'onClose']);

        $this->server->start();
    }

    /**
     * 监听ws连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws, $request)
    {
        var_dump($request->fd);
        if ($request->fd == 1) {
            swoole_timer_tick(2000, function ($timerId) {
                echo "2s: timerId: {$timerId} \n";
            });
        }
    }

    /**
     *
     * @param $ws swoole_websocket_server
     * @param $frame
     */
    public function onMessage($ws, $frame)
    {
        echo "server-message {$frame->data} \n";

        // 投递一个异步的任务
        $data = [
            'task' => 1,
            'fd' => $frame->fd
        ];

        $ws->task($data);
        swoole_timer_after(5000, function () use ($ws, $frame) {
            echo "5s-after \n";
            $ws->push($frame->fd, "server-");
        });
        $ws->push($frame->fd, "server-push:" . date('Y-m-d'));
    }

    /**
     * @param $serv
     * @param $taskId
     * @param $workerId
     * @param $data
     * @return string
     */
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
}


$obj = new webSocket();