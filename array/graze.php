<?php
include dirname(__DIR__).'/vendor/autoload.php';

use Graze\Sort;


$arr = [
    'p' => ['a' => 5],
    'l'=>['a' => 1],
    'n'=>['a' => 1],
    ['a' => 9],
    ['a' => 51],
    ['a' => 15],
    ['a' => 15],
    ['a' => 56],
    'p123' => ['a' => 8],
];

/*uasort($arr, Sort::comparisonFn(function ($v) {
    return $v['a'];
}));*/

Sort::schwartzian($arr, function ($v){return $v['a'];});
var_dump($arr);