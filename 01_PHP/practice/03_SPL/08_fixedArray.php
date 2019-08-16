<?php

$array = new SplFixedArray(5);

$array[1] = 2;
$array[4] = 'foo';

$array->setSize(10);

var_dump($array);