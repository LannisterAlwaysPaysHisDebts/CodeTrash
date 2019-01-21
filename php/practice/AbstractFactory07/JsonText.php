<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2019/1/14
 * Time: 下午2:07
 */

namespace php\practice\AbstractFactory07;


class JsonText extends Text
{
    // todo
    public function __construct(string $text)
    {
        parent::__construct($text);
    }

    public function beJson()
    {
        $this->text = json_encode($this->text);
    }
}