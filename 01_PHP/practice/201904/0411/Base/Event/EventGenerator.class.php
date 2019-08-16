<?php
/**
 * 观察者模式
 *
 * 这是观察者模式的抽象类, 代表事件的生产者
 *
 *
 */

namespace Base\Event;


abstract class EventGenerator
{
    private $observers = [];

    function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}