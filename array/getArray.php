<?php

#输入m.n参数，获取一个m长度的都是n的数组 不能用循环

function getArray($m, $n)
{
    $arr = array_fill(0, $m, $n);
    return $arr;
}
