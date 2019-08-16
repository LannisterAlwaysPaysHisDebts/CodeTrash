<?php
/**
 */

namespace php\practice\AbstractFactory07;


abstract class AbstractFactory
{
    abstract public function createText(string $content): Text;
}