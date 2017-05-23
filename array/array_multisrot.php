<?php
/**
 * 二维数组按某一个字段排序
 **/

 $arr = [
    ['a' => 5],
    ['a' => 1],
    ['a' => 9],
    ['a' => 51],
    ['a' => 15],
    ['a' => 15],
    ['a' => 56],
    ['a' => 5],
 ];

//  $tmp = [];
//  foreach ($arr as $k => $v) {
//      $tmp[$k] = $v['a'];
//  }
//  array_multisort($tmp, SORT_ASC, $arr);
//  var_dump($arr);

 function array_msort(array $arr, $column, $sort = SORT_ASC)
 {
     $tmpArr = array_column($arr, $column);
     array_multisort($tmpArr, $sort, $arr);
     return $arr;
 }

 $result = array_msort($arr, 'a');
 var_dump($result);