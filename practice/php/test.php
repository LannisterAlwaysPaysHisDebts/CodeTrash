<?php

$ch = curl_init('http://www.baidu.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_exec($ch);
echo curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);