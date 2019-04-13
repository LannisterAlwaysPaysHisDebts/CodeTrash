<?php
/**
 * 策略模式
 *
 * 通用接口, 获取广告和商品分类
 *
 *
 *
 */

namespace Base;

interface UserStrategy
{
    function showAd();
    function showCategory();
}


class Page
{
    /**
     * @var UserStrategy
     */
    protected $strategy;

    public function index()
    {
        $ad = $this->strategy->showAd();
        $category = $this->strategy->showCategory();

        // do sth
    }

    public function setStrategy(UserStrategy $strategy)
    {
        $this->strategy = $strategy;
    }
}

/**
 * 这里是使用的依赖注入???
 * 就是Page类不用关心UserStrategy类传进来的是一个什么样具体的实现(是男生还是女生)
 * 只需要调用UserStrategy接口固定实现的两个方法: showAd和showCategory
 *
 * 这种情况我能想象的一个好处就是在最外层获取到用户性别数据的时候就实例化了对应的对象,而后所有的逻辑都不用进行修改,
 * 比如在下面这个逻辑里面增加了一个儿童用户, 只需要新建立一个ChildUserStrategy类,
 * 然后在最外层获取数据的地方加一个if (type == 'Child'){ new ChildUserStrategy, 而后所有的方法都不用动
 *
 */
$page = new Page();
if ($_GET['Female']) {
    $strategy = new FemaleUserStrategy();
} else {
    $strategy = new MaleUserStrategy();
}

$page->setStrategy($strategy);
$page->index();