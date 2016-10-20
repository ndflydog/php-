<?php

/**
 *在函数中引入脚本 脚本仍然能读取到args, argv变量? 需要自己绑定args到指定脚本 否则使无法传递到requrie下一脚本
 */

 function S()
 {
     require __DIR__.'/shell.php';
 }

 s();