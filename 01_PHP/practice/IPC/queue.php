<?php
$parentPid = getmygid();
$childList = [];

$id = ftok(__FILE__, 'm');
$msgQueue = msg_get_queue($id);

const MSG_TYPE = 1;

function producer()
{
    global $msgQueue;
}
