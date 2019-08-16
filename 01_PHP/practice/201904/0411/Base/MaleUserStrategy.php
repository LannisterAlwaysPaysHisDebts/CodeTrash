<?php
/**
 * 策略模式
 *
 * 针对男性用户的策略1
 *
 *
 */

namespace Base;

class MaleUserStrategy implements UserStrategy
{
    public function showAd()
    {
        return "新款单反";
    }

    public function showCategory()
    {
        return "电子产品";
    }
}