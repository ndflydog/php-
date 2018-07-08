<?php

$i = 0;

$ascii = [];
while ($i < 128) {
    $ascii[$i] = chr($i);
    $i++;
}
var_dump($ascii);