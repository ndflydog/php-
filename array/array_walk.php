<?php

#array_walk中途返回
define('REQUEST_URI', '/gg');
$noCsrfArr = [
    '/admin',
    '/hezi/win',
    '/client/login'
];

function crsfCheck($v)
{
    if(false !== strpos(REQUEST_URI, $v)) {
        return false;
    }
    return true;
}

#是否开启csrf
if (count(array_filter($noCsrfArr, 'crsfCheck')) < count($noCsrfArr)) {
    echo '不开启';
} else {
    echo '开启';
}
