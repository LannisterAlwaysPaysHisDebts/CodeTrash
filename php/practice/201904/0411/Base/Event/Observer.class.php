<?php
/**
 * 观察者模式的观察者
 *
 *
 */

namespace Base\Event;


interface Observer
{
    public function update($event_info = null);
}