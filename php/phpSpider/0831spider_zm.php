<?php
/**
 * 抓成语
 */

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

$baseUrl = 'http://www.tom61.com/caimiyu/naojinjizhuanwan/index_%s.html';



$url = sprintf($baseUrl, 2);

$html = \QL\QueryList::get($url)->getHtml();
var_dump($html);



