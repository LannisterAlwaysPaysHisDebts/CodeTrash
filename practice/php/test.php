<?php

$path = __DIR__ . '/file.txt';

$data = 'aaaa' . "\r";

file_put_contents($path, $data, FILE_APPEND);