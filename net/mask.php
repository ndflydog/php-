<?php
/**
 * 更加ip地址和子网掩码算出网段
 * 
 * */
 
function net($ip, $mask)
{
    $ipArr = explode('.', $ip);
    $maskArr = explode('.', $mask);
    $ipArr = array_map(function($v) {
        return decbin($v);
    }, $ipArr);
    $maskArr = array_map(function($v) {
        return decbin($v);
    }, $maskArr);
    $resultArr = array_map(function($i, $m) {
        $b = decbin(255);
        return bindec($b & $i & $m);
    }, $ipArr, $maskArr);
    return implode('.', $resultArr);
}

$ip = '192.168.176.0';
$ip2 = '192.168.182.0';
$mask = '255.255.248.0';
echo net($ip, $mask);
echo PHP_EOL;
echo net($ip2, $mask);