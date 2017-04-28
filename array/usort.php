<?php

$arr = [
    'abc',
    '123',
    'asfasfa',
    '哈哈',
];

usort($arr, function($a, $b) {
    echo $a.PHP_EOL;
    echo $b.PHP_EOL;
    echo '--------'.PHP_EOL;
    $aL = mb_strlen($a);
    $bL = mb_strlen($b);
    echo $aL - $bL;
    echo PHP_EOL;
    return $aL - $bL;
});

var_dump($arr);

