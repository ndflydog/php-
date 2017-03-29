<?php

$str = 'abc';
$str2 = 'bcadabc';

$length = strlen($str2);
for ($i = 0; $i < $length; $i++) {
    $tmpi = $i;
    for ($j = 0; $j < strlen($str); $j++) {
        if ($str2[$tmpi] != $str[$j]) {
            break;
        }
        if (($j + 1) == strlen($str)) {
            echo '有匹配';
            return;
        }
        $tmpi++;
    }
    echo 'tmpi'.$tmpi.PHP_EOL;    
    echo 'j'.$j.PHP_EOL;    
}
echo '无匹配';