<?php
/**
 * redis
 *
 *
 *
 */


$redisClient = new swoole_redis;

$redisClient->connect('127.0.0.1', 6379, function (swoole_redis $redisClient, $result) {
    echo "connect " . PHP_EOL;
    var_dump($result); // bool返回值


    // get
//    $key = 'thisTestKey';
//    $value = time();
//    $redisClient->set($key, $value, function (swoole_redis $redisClient, $result) {
//        var_dump($result); // 设置成功返回OK
//    });


    // set
//    $redisClient->get($key, function (swoole_redis $redisClient, $result) {
//        var_dump($result);
//
//        $redisClient->close();
//    });

    $redisClient->keys('*', function (swoole_redis $redisClient, $result){
        var_dump($result);
    });

});

echo "start" . PHP_EOL;