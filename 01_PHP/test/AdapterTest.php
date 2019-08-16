<?php
/**
 *
 * 适配器测试
 */

namespace php\test;

use PHPUnit\Framework\TestCase;
use php\practice\Adapter11\Book;
use php\practice\Adapter11\Kindle;
use php\practice\Adapter11\EBookAdapter;

require dirname(__DIR__) . '/autoload.php';

class AdapterTest extends TestCase
{
    public function testCanTurnPageOnBook()
    {
        $book = new Book();
        $book->open();
        $book->turnPage();

        $this->assertEquals(2, $book->getPage());
    }

    public function testCanTurnPageOnKindleLikeInANormalBook()
    {
        $kindle = new Kindle();
        $book = new EBookAdapter($kindle);

        $book->open();
        $book->turnPage();

        $this->assertEquals(2, $book->getPage());
    }
}