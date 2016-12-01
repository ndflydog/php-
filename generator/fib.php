<?php

function fib($num){ #普通迭代法生成斐波那契数列 数值过大会导致内存暴涨
    if($num < 1) {
        return - 1;
    }
    $arr[0] = 0;
    $arr[1] = 1;
    for ($i = 2; $i < $num ; $i++) { 
        $arr[$i] = $arr[$i-1]+$arr[$i-2];
    }
    return implode(',', $arr);
}

function recursion($num){ #递归法生成黄金数列时 数值过大会导致递归过深二报错
    //判断是否小于0
    if ($num<0) {
            return -1;
    }
    if ($num==1) {
        return 0;
    }
    if($num==2 || $num==3) {
        return 1;
    }
    return recursion($num-1)+recursion($num-2);
}

function fib2($num) #yield 可以防止内存暴涨 直到数值超出范围INF
{
    if($num < 1) {
        return;
    }
    $arr[0] = 0;#数组内存还是会一直在增大
    $arr[1] = 1;
    for ($i = 2; $i < $num ; $i++) { 
        $arr[$i] = $arr[$i-1]+$arr[$i-2];
        yield $arr[$i];
        unset($arr[$i-3]);#清除无用内存
    }
    //return $arr;
}

$start = memory_get_usage().PHP_EOL;

//$arr = fib2(10000);
foreach (fib2(10000000) as $v) {
    if (INF == $v) {
        break;
    }
    echo $v.PHP_EOL;
}
echo $start;
echo PHP_EOL;
echo memory_get_usage();