<?php

$pre = [];
$i = 1;
$handle = fopen('243.txt', 'r');
if ($handle) {
    while (($buffer = fgets($handle)) !== false) {
        if(!trim($buffer)) continue;
        $tmp = explode('----', $buffer);
        if (empty($tmp)) continue;
        $tmpStr = '韩服账号:'.$tmp[0].' 韩服密码:'.$tmp[1];
        array_push($pre, $tmpStr);
        unset($buffer);
        unset($tmp);
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail".PHP_EOL;
    }
    fclose($handle);
}
$str = implode("\n", $pre);
file_put_contents('/home/fly/share/hf.txt', $str);