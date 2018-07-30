<?php
/**
 * 自动加载
 *
 */

spl_autoload_register(function ($class) {

});



//spl_autoload_register(function ($class) {
//    static $class_map = [];
//
//    if (!isset($class_map[$class])) {
//        $class = strtr($class, '\\', DIRECTORY_SEPARATOR);
//
//        $class_file = strpos($class, 'lib') === 0 ? BASEPATH_FRAMEWORK : BASEPATH_MODULE;
//        $class_file .= $class . '.class.php';
//
//        if (is_file($class_file)) {
//            include($class_file);
//        }
//
//        // 无论成功失败, 自动加载只进行一次
//        $class_map[$class] = $class;
//    }
//});

