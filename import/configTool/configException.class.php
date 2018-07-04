<?php
/**
 * Exception
 */

namespace configTool;


class configException extends \Exception
{
    public function getout($code, $msg)
    {
        exit('Error! Code:' . $code . ' Message:' . $msg);
    }

    public function warn($code, $msg)
    {
        var_dump('Warning! Code:' . $code . ' Message:' . $msg);
    }
}