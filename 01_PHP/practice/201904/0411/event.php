<?php
/**
 * 观察者模式的事件发生
 *
 *
 */

require 'autoload.php';

use Base\Event\EventGenerator;

class Event extends EventGenerator
{
    function trigger()
    {
        echo "事件发生" . PHP_EOL;
        $this->notify();
    }
}

$obj = new Event();
$obj->addObserver(new \Base\Event\MasterObserver());
$obj->trigger();