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

$users = new \Base\AllUser();
foreach ($users as $user) {
    var_dump($user);
}