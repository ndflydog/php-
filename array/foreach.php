<?php

$arr = [1,2,3];

#foreach是一个拷贝
foreach($arr as $v) {
    unset($arr[2]);
    echo $v;
}