<?php
/**
 * 代理模式
 *
 *
 *
 */

namespace Base;


interface IUserProxy
{
    function getUserName($id);
    function setUserName($id, $name);
}