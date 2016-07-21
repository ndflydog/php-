<?php

/**
 *  通过array_column实现取出二维数组中的莫一列 或 取莫一列把二维索引数组转换为关联数组
 */
$arr = [
    [
        'id' => '1',
        'name' => 'one',
    ],
    [
        'id' => '2',
        'name' => 'two',
    ],
    [
        'id' => '3',
        'name' => 'three',
    ]
];

$arr = array_column($arr, null, 'name');
var_dump($arr);
