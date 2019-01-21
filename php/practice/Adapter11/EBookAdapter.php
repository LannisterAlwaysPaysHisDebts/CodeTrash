<?php
/**
 * 适配器
 *
 *
 */

namespace php\practice\Adapter11;

/**
 * 这里是一个适配器. 注意他实现了 BookInterface,
 * 因此你不必去更改客户端代码当使用 Book
 */
class EBookAdapter implements BookInterface
{
    /**
     * @var EBookInterface
     */
    private $eBook;

    /**
     * EBookAdapter constructor.
     * @param EBookInterface $eBook
     */
    public function __construct(EBookInterface $eBook)
    {
        $this->eBook = $eBook;
    }

    public function open()
    {
        $this->eBook->unlock();
    }

    public function turnPage()
    {
        $this->eBook->pressNext();
    }

    /**
     * 注意这里适配器的行为： EBookInterface::getPage() 将返回两个整型，除了 BookInterface
     * 仅支持获得当前页，所以我们这里适配这个行为
     *
     * @return int
     */
    public function getPage(): int
    {
        return $this->eBook->getPage()[0];
    }
}