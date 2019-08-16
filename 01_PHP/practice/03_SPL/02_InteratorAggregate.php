<?php
/**
 * 聚合式迭代器的用法
 * 创建外部迭代器的接口
 */

class myData implements IteratorAggregate
{
    public $property2 = "Public property two";
    protected $property1 = 'Public property one';
    public $property3 = "Public property three";

    public function __construct()
    {
        $this->property4 = 'last property';
    }

    public $aaa = 'test1    ';

    public function getIterator()
    {
        // 这里的遍历貌似是按照变量顺序遍历的
        return new ArrayIterator($this);
    }
}

$obj = new myData();

var_dump($obj);

foreach ($obj as $key => $value) {
    var_dump($key, $value);
    echo "\n";
}


