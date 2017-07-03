<?php

/**
 * 阻塞式写法
 */
echo 'exec调用阻塞'.PHP_EOL;

exec('php sleep.php');

echo '!'.PHP_EOL;

/**
 * 非阻塞式写法
 */

echo 'exec调用非阻塞'.PHP_EOL;

exec('php sleep.php > /dev/null &');

echo '!!'.PHP_EOL;