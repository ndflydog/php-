<?php
$arr1 = [1, 2];
$arr2 = ['a', 'b'];
$arrKv = ['a' => 1, 'b' => 2];

#传入多个数组 key 会重置为数字
$arr3 = array_map(function ($arr1Val, $arr2Val) {
    return [$arr2Val => $arr1Val];
}, $arr1, $arr2);

#如果只传入一个数组k v会被保留
var_dump(array_map(function ($val) {
    return $val;
}, $arrKv));