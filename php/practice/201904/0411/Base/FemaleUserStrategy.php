<?php
/**
 * 策略模式:
 *
 * 针对女性用户的策略
 *
 */

namespace Base;

class FemaleUserStrategy implements UserStrategy
{
    public function showAd()
    {
        return "2018新款女装";
    }

    public function showCategory()
    {
        return "女装";
    }
}