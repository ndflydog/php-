<?php
#设置php.ini中output_buffering = 32
#使用apache可以看到效果 #nginx+php-fpm看不到效果 nginx缓存 sockets通信问题？
#implicit_flush = 1;
ob_implicit_flush();
echo str_repeat('a', 32);
sleep(2);
echo 'b';
ob_implicit_flush();
sleep(3);
echo 'c';
