<?php

$server = new swoole_websocket_server('0.0.0.0', 9502);

// $server->set([]);

// 监听ws消息事件
$server->on('open', 'onOpen');
function onOpen($server, $request){
    print_r($request->fd);
}

$server->on('message', function($server, $frame){
    echo "Receive from {$frame->fd}: {$frame->data}, opcode: {$frame->opcode}, fin: {$frame->finish} \n";
    $server->push($frame->fd, 'this is server');
});

$server->on('close', function($server, $fd){
    echo "client {$fd} closed \n";
});

$server->start();