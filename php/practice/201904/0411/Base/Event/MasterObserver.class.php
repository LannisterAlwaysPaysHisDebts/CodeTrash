<?php
/**
 *
 *
 *
 *
 */

namespace Base\Event;


class MasterObserver implements Observer
{
    public function update($event_info = null)
    {
        echo "I'm Master,  Info: $event_info" . PHP_EOL;
    }
}