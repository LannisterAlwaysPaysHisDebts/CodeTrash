<?php

namespace php\practice\Prototype10;


class BarBookPrototype extends BookPrototype
{
    protected $category = 'Bar';

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}