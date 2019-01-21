<?php

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

// 自动加载
spl_autoload_register(function ($class){
    static $classMap = [];
    $class = strtr($class, '\\', '/');
    if (!isset($classMap[$class])) {
        $path = dirname(dirname(__DIR__)) . '/' . $class . '.php';
        $path2 = dirname(dirname(__DIR__)) . '/' . $class . '.class.php';
        if (is_file($path)) {
            require $path;
        } else if (is_file($path2)) {
            require $path2;
        }
        $classMap[$class] = $path;
    }
});


$obj = new \php\test\AbstractFactoryTest();
$res = $obj->testCreateJsonText();
