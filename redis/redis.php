<?php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->auth(123456);
$redis->select(4);

$redis->hset('test', 'one', [
    '1',
    '2',
    '3',
    '4'
]);