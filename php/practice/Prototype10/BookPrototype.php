<?php
/**
 *  原型模式
 *
 */

namespace php\practice\Prototype10;


class BookPrototype
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    protected $category;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }
}