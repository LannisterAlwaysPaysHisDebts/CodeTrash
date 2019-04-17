<?php
/**
 * 自动加载封装
 *
 *
 *
 *
 */

if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__) . '/');
}

class Autoloader
{
    public static function register($class)
    {
        static $classMap = [];
        $class = strtr($class, '\\', DIRECTORY_SEPARATOR);
        if (!isset($classMap[$class])) {
            $path = ROOT . $class . '.php';
            $classPath = ROOT . $class . '.class.php';

            if (file_exists($path)) {
                require $path;
                return true;
            } elseif(file_exists($classPath)) {
                require $classPath;
                return true;
            } else {
                return false;
            }
        }

        return false;
    }
}

spl_autoload_register('Autoloader::register');
