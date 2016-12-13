<?php
/**
 *流句柄 经过json_encode 和 json_decode后还可以继续使用么
 *
 */

$fb = fopen('/home/php-/file/file.txt', 'r');
if (!$fb) {
    die('打开失败');
}
$str = fgets($fb);
//会报错 因为 json_encode可以encode所有类型 除了resource类型
$encode = json_encode(['fb' => $fb]);

var_dump(json_last_error());

echo $str;
fclose($fb);