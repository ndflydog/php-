<?php

$arr = [1, 1];

echo $arr[0];
echo $arr[1];
$i = 1;
while($i) {
    if ($i == 100) {
        $i = 0;
    } else {
        $i++;        
    }
    $tmp = $arr[0] + $arr[1];
    $arr[0] = $arr[1];
    $arr[1] = $tmp;
    echo $tmp.PHP_EOL; 
}