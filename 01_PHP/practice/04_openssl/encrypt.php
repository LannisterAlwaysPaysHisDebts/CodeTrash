<?php
// 在php7.0以前, 都是使用mcrypt_decrypt/mcrypt_encrypt 进行aes加/解密
// 在php7.0之后弃用了mcrypt 而是改用了openssl

if (PHP_SAPI != 'cli') {
    exit();
}

