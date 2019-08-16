<?php
/**
 * 适配器模式
 *
 *
 */

namespace Base\Database;


interface IDatabase
{
    function connect($host, $user, $passwd, $dbname);
    function query($sql);
    function close();
}