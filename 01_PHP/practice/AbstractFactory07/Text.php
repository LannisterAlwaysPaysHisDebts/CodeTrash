<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2019/1/14
 * Time: 下午2:06
 */

namespace php\practice\AbstractFactory07;


abstract class Text
{
    protected $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }
}