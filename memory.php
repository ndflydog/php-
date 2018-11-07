<?php
echo memory_get_usage().PHP_EOL;
$a = "1";
echo memory_get_usage().PHP_EOL;
$r = [];
echo memory_get_usage().PHP_EOL;
for($i = 0; $i < 10; $i++) {
   echo memory_get_usage().PHP_EOL;
   $r[] = $i; 
}
   echo memory_get_usage().PHP_EOL;
