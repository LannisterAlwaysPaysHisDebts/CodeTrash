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

$page = new Page();
if ($_GET['Female']) {
    $strategy = new FemaleUserStrategy();
} else {
    $strategy = new MaleUserStrategy();
}

$page->setStrategy($strategy);
$page->index();