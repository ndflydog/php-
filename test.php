<?php

$a = 'hi';
$b = &$a;
#debug_zval_dump($a);
xdebug_debug_zval('a');
echo '中国';
