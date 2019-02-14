<?php

$client = new swoole_client(SWOOLE_SOCK_UDP);

fwrite(STDOUT, "输入消息: ");
$msg = trim(fgets(STDIN));

$client->sendto('127.0.0.1', 9502, $msg);

$result = $client->recv();
var_dump($result);