<?php

namespace php\practice\Adapter11;


interface BookInterface
{
    public function turnPage();

    public function open();

    public function getPage(): int;
}