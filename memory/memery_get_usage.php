<?php

echo memory_get_usage().PHP_EOL;
$a = 1;
$b = $a;
$a = null;
$b = null;
unset($a);
unset($b);
echo memory_get_usage().PHP_EOL;