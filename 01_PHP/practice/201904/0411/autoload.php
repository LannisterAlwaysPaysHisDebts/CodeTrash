<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2019/4/14
 * Time: 上午12:42
 */

spl_autoload_register(function ($class){
    $class = str_replace('\\', '/', $class);
    require __DIR__ . "/{$class}.class.php";
});
