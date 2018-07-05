<?php

if ($app == 'aaa' || $app == 'bbb' || $app == 'ccc' || $app == 'ddd') {
    echo 'pass';
}

if ('aaa' == $app || 'bbb' == $app || 'ccc' == $app || 'ddd' == $app) {
    echo 'pass';
}

if (in_array($app, [
    'aaa',
    'bbb',
    'ccc',
    'ddd'
])) {
    
}