<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2019/1/14
 * Time: 下午2:08
 */

namespace php\test;

require dirname(__DIR__) . '/autoload.php';

use php\practice\AbstractFactory07\HtmlText;
use php\practice\AbstractFactory07\HtmlFactory;
use php\practice\AbstractFactory07\JsonFactory;
use php\practice\AbstractFactory07\JsonText;
use PHPUnit\Framework\TestCase;

class AbstractFactoryTest extends TestCase
{
    public function testCreateJsonText()
    {
        $factory = new JsonFactory();
        $text = $factory->createText('foobar');

        $this->assertInstanceOf(JsonText::class, $text);
    }
}

