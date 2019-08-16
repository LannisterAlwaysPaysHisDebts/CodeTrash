<?php
/**
 * 使用反射来动态调用类和方法
 * 
 * 目前兼容调用有参数的公共类
 * 
 */

// 命令提示的帮助文案, 这里懒得写了
$help = <<<EOF
类:方法 参数1 参数2 ...\n
EOF;

// 取命令行的输入作为参数, 第一个参数的格式是 类:方法 后面的参数都是对应该方法的参数
// 如: php 03_call_user_func.php List:get 111 就是调用list类的get方法,传的一个参数为111
$main = $argv[1];
$cmdParams = array_slice($argv, 2);
if(empty($main) || strpos($main, ':') === false) {
    exit($help);
}

list($class, $method) = explode(':', $main);
if (!class_exists($class)) {
    exit("类不存在" . PHP_EOL);
}

$obj = new $class();
if (!method_exists($obj, $method)) {
    exit("方法不存在" . PHP_EOL);
}

try{
    $reflection = new ReflectionMethod($class, $method);

    if (!$reflection->isPublic) {
        throw new ReflectionException("方法不允许调用!");
    }

    if (empty($reflection->getParameters())) {
        $obj->$method();
    } else {
        $params = [];
        foreach($reflection->getParameters() as $key => $value) {
            if (isset($cmdParams[$key])) {
                $params[$key] = $cmdParams[$key];
            } elseif ($value->isDefaultValueAvailable()) {  // 兼容默认参数
                $params[$key] = $value->getDefaultValue();
            } else {
                throw new ReflectionException("方法: '{$method}' 需要参数: '{$value->name}'");
            }
        }

        // 调用该方法
        call_user_func_array([$class, $method], $params);
    }
}catch(ReflectionException $e){
    exit($e->getMessage() . PHP_EOL);
}

