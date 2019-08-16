<?php
/**
 * 闭包2
 *
 *
 */

/**
 * @param $code
 * @param string $id
 * @param string $class
 * @return Closure
 */
function html($code, $id = "", $class = "")
{
    if ($id !== "") $id = " id = \"$id\"";

    $class = ($class !== "") ? " class =\"$class\"" : ">";

    $open = "<$code$id$class";

    $close = "</$code>";

    return function ($inner = "") use ($open, $close) {

        return "$open$inner$close";
    };

}


$a = html('html', 'aaaa', 'input');

var_dump($a);