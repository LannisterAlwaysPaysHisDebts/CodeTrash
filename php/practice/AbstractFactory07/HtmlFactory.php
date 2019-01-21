<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2019/1/14
 * Time: 下午2:05
 */

namespace php\practice\AbstractFactory07;


class HtmlFactory extends AbstractFactory
{
    public function createText(string $content): Text
    {
        return new HtmlText($content);
    }
}