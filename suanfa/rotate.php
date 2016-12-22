<?php

#把字符串abcdef的前3个字符a, b, c移到字符串的尾部 => defabc
#蛮力移位法
/**
 *@$str string
 *@$n strlen($string)
 */
function LeftShiftOne(&$str, $n)
{
    $first = $str[0];
    for ($i = 1; $i < $n; $i++) {
        $str[$i - 1] = $str[$i];
    }
    $str[$n - 1] = $first;
}

/**
 *@$str string
 *@$n int strlen(string)
 *@$m int 字符串分离的长度
 */
function LeftRotateStr(&$str, $n, $m)
{
    while($m--) {
        LeftShiftOne($str, $n);
    }
}


/**
 *@str string
 *@from int 开始分离的位置
 *@to int 结束分离的位置
 */
function ReverseStr(&$str, $from, $to)
{
    while($from < $to) {
        $tmpStr = $str[$from];
        $str[$from++] = $str[$to];
        $str[$to--] = $tmpStr;
    }
}

/**
 *@$str string
 *@$n int strlen($str)
 *@$to int 结束分离的位置
 */
function LeftRotateStr2(&$str, $n, $m)
{
    $m %= $n;
    ReverseStr($str, 0, $m - 1);
    ReverseStr($str, $m, $n - 1);
    ReverseStr($str, 0, $n - 1);
}
echo $start = time();
$str = 'abcdeffasfasfasfasdfasdfasfasfasfasdfasdfasfasfasfasfasfasfasdfasfasfasdfasdfsd';
echo $str;
LeftRotateStr($str, strlen($str), 40);
echo $str;
echo time() - $start;