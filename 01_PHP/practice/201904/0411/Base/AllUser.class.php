<?php
/**
 * 迭代器模式
 * 继承php自带的Iterator迭代器类
 *
 *
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
     * @var
     */
    protected $ids;
    /**
     * @var array
     */
    protected $data = [];
    /**
     * @var
     */
    protected $index;

    /**
     * AllUser constructor.
     *
     * 生成数据
     */
    public function __construct()
    {
        $db = MySqlFactory::getDb();
        $result = $db->query("select InviteId from UserInvite");
        $this->ids = $result->fetchAll(\PDO::FETCH_ASSOC);
        var_dump($this->ids);
    }

    /**
     * 获取当前元素
     *
     * @return mixed|void
     */
    public function current()
    {
        $id = $this->ids[$this->index]['InviteId'];
        return MySqlFactory::getUserInvite($id);
    }

    /**
     * 获取下一个元素
     */
    public function next()
    {
        $this->index++;
    }

    /**
     * 验证当前是否还有下一个元素
     *
     * @return bool|void
     */
    public function valid()
    {
        return $this->index < count($this->ids);
    }

    /**
     * 重置迭代器
     */
    public function rewind()
    {
        $this->index = 0;
    }

    /**
     * 获取迭代器的位置
     *
     * @return mixed|void
     */
    public function key()
    {
        return $this->index;
    }
}