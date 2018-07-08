<?php

$arr1 = [2, 3,4,5,6,1,1,1,1,1,1];
$arr2 = [4,4,4,6,7,8,9,1];

$length1 = count($arr1);
$length2 = count($arr2);

$length = $length1 > $length2 ? $length1 : $length2;

$result1 = [];
$result2 = [];

#先转换未key values
for ($i = 0; $i < $length; $i++) {
    if (isset($arr1[$i])) {
        if (!isset($result1[$arr1[$i]])) {
            $result1[$arr1[$i]] = 1;
        } else {
            $result1[$arr1[$i]] += 1;
        }
    }

    if (isset($arr2[$i])) {
        if (!isset($result2[$arr2[$i]])) {
            $result2[$arr2[$i]] = 1;
        } else {
            $result2[$arr2[$i]] += 1;
        }
    }
}


$result = [];

$firstKey = '';
foreach ($result1 as $k => $v) {
    if (isset($result2[$k])) {
        $val = $v + $result2[$k];
        if (!$firstKey) {
            $firstKey = $k;
            $result[$k] = $val;
        } else if ($val > $result[$firstKey]) {
            $firstKey = $k;
            $result = [$k => $val] + $result;
        } else {
            $result[$k] = $val;
        }
        $result[$k] = $val;
    }
}
var_dump($result);
