<?php
/**
 * string 的一些处理
 *
 *
 */


//转换成为utf8
function convToUtf8($str) {
    if( mb_detect_encoding($str,"UTF-8, ISO-8859-1, GBK")!="UTF-8" ) {
        return  iconv("gbk","utf-8",$str);
    } else {
        return $str;
    }
}
