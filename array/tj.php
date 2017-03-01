<?php

$pre = [];
$handle = fopen('/home/fly/l3redis.log', 'r');
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        $tmp = explode(':', $buffer)[0];
        if (!$pre[$tmp]) {
            $pre[$tmp] = 1;
        }
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail".PHP_EOL;
    }
    fclose($handle);
}
$keys = array_keys($pre);
foreach($keys as $v) {
    echo $v.PHP_EOL;
}
echo count($keys);