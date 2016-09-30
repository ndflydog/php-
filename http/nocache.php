<?php
namespace ceshi;

echo mb_strlen("和");
$time = time();

$interval = 360000;
ob_start();
// header('Expires: '.gmdate('r',($time+$interval)));

// header('Cache-Control: max-age='.$interval);

// header('Last-Modified: '.gmdate('r',$time));

echo '这是一个缓存测试！'.time();
ob_end_flush();