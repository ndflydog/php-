<?php

var_dump($argv);die;
$stdin = fopen('php://stdin', 'r');

$line = trim(fgets($stdin));

fclose($stdin);
file_put_contents('/tmp/std.log', $line);

