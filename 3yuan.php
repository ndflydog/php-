<?php

$a = range(1, 1000);
$i = 0;
 
$start = microtime(true);
while (++$i < 1000) {
    $b = isset($a)? $a : NULL;
}
 
var_dump(microtime(true) - $start);
#相比, 我们采用if-else来做同样的功能:

$a = range(1, 1000);
$i = 0;
 
$start = microtime(true);
while (++$i < 1000) {
    if (isset($a)) {
        $b = $a;
    } else {
        $b = NULL;
    }
}
var_dump(microtime(true) - $start);
