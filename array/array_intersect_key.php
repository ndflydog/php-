<?php

$arr1 = [
    'a' => 123,
    'b' => 123,
    'd' => 123,
    'e' => 123,
    'c' => 123,
    123 => 123,
    'f' => 123,
];

$arr2  = [
    'b' => 123,
    'c' => 123,
    'f' => 123,
    'a' => 123,
    123 => 789
];

$arr3 = array_intersect_key($arr1, $arr2);
var_dump($arr3);