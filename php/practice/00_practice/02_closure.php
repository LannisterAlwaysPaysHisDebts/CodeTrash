<?php
/**
 * 闭包
 *
 *
 */

class Cart
{
    const PRICE_BUTTER = 1.00;
    const PRICE_MILK = 3.00;
    const PRICE_EGGS = 6.95;

    protected $products = [];

    public function add($products, $quantity)
    {
        $this->products[$products] = $quantity;
    }

    public function getQuantity($product)
    {
        return isset($this->products[$product]) ? $this->products[$product] : false;
    }

    public function getTotal($tax)
    {
        $total = 0.00;

        // 使用闭包来代替循环
        $callback = function ($quantity, $product) use ($tax, &$total) {

            // 使用constant获取常量
            $pricePerItem = constant(__CLASS__ . "::PRICE_" . strtoupper($product));

            $total += ($pricePerItem * $quantity) * ($tax + 1.0);
        };

        array_walk($this->products, $callback);

        return round($total, 2);
    }

    public function getTotalV2($tax)
    {
        $total = 0.00;

        foreach ($this->products as $product => $quantity) {
            $pricePerItem = constant(__CLASS__ . "::PRICE_" . strtoupper($product));

            $total += ($pricePerItem * $quantity) * ($tax + 1.0);
        }

        return round($total, 2);
    }
}

$my_cart = new Cart();

// 往购物车里面添条目
$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);

$tax = 0.05;
// 打印出总价格, 其中有5%的交易税
// print $my_cart->getTotal($tax) . PHP_EOL;
// print $my_cart->getTotalV2($tax) . PHP_EOL;


// 性能测试
$times = 1000000;

//echo "使用闭包耗时: " . $time1 . "s" . PHP_EOL . "使用foreach耗时: " . $time2 . "s" . PHP_EOL;

// 结果:
// 使用闭包耗时: 6s
// 使用foreach耗时: 4s
// 闭包性能不如foreach
