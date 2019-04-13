<?php
/**
 * 策略模式
 *
 *
 *
 *
 */

spl_autoload_register(function ($class){
    $class = str_replace('\\', '/', $class);
    require __DIR__ . "/{$class}.class.php";
});

$userInvite = \Base\MySqlFactory::getUserInvite(1);

$userInvite->masterUserId = 5;
$userInvite->appUserId = 6;
$userInvite->createTime = date('Y-m-d H:i:s');



