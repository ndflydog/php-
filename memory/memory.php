<?php
    echo memory_get_usage().PHP_EOL;
    $str = 1;
    for ($i = 0; $i < 1000000; $i++) {
        $str += $i;
    }
    echo memory_get_usage();