<?php

$arr = [
    'ip' => 1111,
    'time' => 2222,
];

$en = json_encode($arr);
$de = json_decode($en, true);

var_dump($de);
