<?php
/**
 * Created by PhpStorm.
 * User: caoting
 * Date: 2018/8/16
 * Time: 上午11:37
 */

$fruits = array(
    "apple" => "yummy",
    "orange" => "ah ya, nice",
    "grape" => "wow, I love it!",
    "plum" => "nah, not me"
);

$obj = new ArrayObject($fruits);
$it = $obj->getIterator();

while($it->valid()) {
    echo  $it->key() . ' => ' . $it->current() . "\n";
    $it->next();
}
