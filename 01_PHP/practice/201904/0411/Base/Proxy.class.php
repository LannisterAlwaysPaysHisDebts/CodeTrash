<?php
/**
 * 代理模式
 *
 *
 *
 */

namespace Base;


class Proxy implements IUserProxy
{
    public function getUserName($id)
    {
        // todo: 从读库获取数据
    }

    public function setUserName($id, $name)
    {
        // TODO: 从主库获取数据
    }
}