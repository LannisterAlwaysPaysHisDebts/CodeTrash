<?php
// 在php7.0以前, 都是使用mcrypt_decrypt/mcrypt_encrypt 进行aes加/解密
// 在php7.0之后弃用了mcrypt 而是改用了openssl

if (PHP_SAPI != 'cli') {
    exit();
}

$iv= md5(time(). uniqid(),true);
$str="Hello， world！";
# 加密 md5->true 为16位md5
echo $strEncode= base64_encode(openssl_encrypt($str, 'AES-128-CBC',KEY, OPENSSL_RAW_DATA , $iv));   # AES-256-CBC

echo openssl_decrypt(base64_decode($strEncode), 'AES-128-CBC', KEY, OPENSSL_RAW_DATA, $iv);
