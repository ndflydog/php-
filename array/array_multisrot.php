<?php
/**
 * 二维数组按某一个字段排序
 **/

 $arr = [
    'p' => ['a' => 5],
    ['a' => 1],
    ['a' => 9],
    ['a' => 51],
    ['a' => 15],
    ['a' => 15],
    ['a' => 56],
    123 => ['a' => 8],
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


function array_msort2(array $list, $field, $sortby = 'asc')
{
    $refer = $resultSet = [];
    foreach ($list as $i => $data) {
        $refer[$i] = $data[$field];
    }
    switch ($sortby)
    {
        case 'asc': // 正向排序
            asort($refer);
            break;
        case 'desc': // 逆向排序
            arsort($refer);
            break;
        case 'nat': // 自然排序
            natcasesort($refer);
            break;
    }
    foreach ($refer as $key => $val)
    {
        $resultSet[] = $list[$key];
    }
    return $resultSet;
}