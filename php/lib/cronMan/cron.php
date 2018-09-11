<?php
/**
 * 入口文件
 */

require __DIR__ . '/cronMan.class.php';

$obj = new cronMan();
$obj->start();