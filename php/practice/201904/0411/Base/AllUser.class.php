<?php
/**
 * 迭代器模式
 * 使用
 *
 */

namespace Base;


/**
 * Class AllUser
 * @package Base
 */
class AllUser implements \Iterator
{
    /**
     * AllUser constructor.
     */
    public function __construct()
    {
        $db = MySqlFactory::createDb();
        $db->query();
    }

    /**
     * 获取当前元素
     *
     * @return mixed|void
     */
    public function current()
    {
        // TODO: Implement current() method.
    }

    /**
     * 获取下一个元素
     */
    public function next()
    {
        // TODO: Implement next() method.
    }

    /**
     * 验证当前是否还有下一个元素
     *
     * @return bool|void
     */
    public function valid()
    {
        // TODO: Implement valid() method.
    }

    /**
     * 重置迭代器
     */
    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    /**
     * 获取迭代器的位置
     *
     * @return mixed|void
     */
    public function key()
    {
        // TODO: Implement key() method.
    }
}