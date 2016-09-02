<?php

$arr = ['a' => 1, 'b' => 2, 'c' => 3];

foreach ($arr as $k => $v) {
    $$k = $v;
}

echo $a;
echo $b;
echo $c;
