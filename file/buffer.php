<?php

/**
 * 打开缓冲 用strace php buffer.php 观察调用了一次write("123")
 * 打开缓冲 用strace php buffer.php 观察调用了一次write("1") write("2) write("3")
 */
ob_start();
echo 1;
echo 2;
echo 3;
ob_flush();