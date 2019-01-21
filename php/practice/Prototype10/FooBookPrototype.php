<?php

namespace php\practice\Prototype10;


class FooBookPrototype extends BookPrototype
{
    protected $category = 'Foo';

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}