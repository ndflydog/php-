<?php
/*
设置使用set_error_handler()函数接管php自身的错误处理机制以后，以后发生错误以后，就会
直接调用set_error_handler()中指定的回调函数。并将错误相关的信息，比如说错误行号，文件
名等信息传递到该回调函数。设置set_error_handler()函数以后，原先使用的@这个屏蔽错误的
语法糖就失去了作用
*/
function error_handler($errno, $errstr, $errfile, $errlime)
{
    echo '错误捕获';  
    switch($errno) {
        case 2:
            $error_type = "E_WARNING";
            break;
        case 8:
            $error_type = "E_NOTICE";
            break;
        default:
            $error_type = "";
            break;
    }
    echo $error_type."<br/>";
    echo $errstr."<br/>";
    echo $errfile."<br/>";
    echo $errline."<br/>";
    echo "<pre/>";
    //print_r(debug_backtrace());
    die();
}
set_error_handler("error_handler");
try {
    fopen('/tmp/ttttt.log', 'r');    #php老旧函数直接抛出错误 不能用try catch 异常捕获
} catch (\Exception $e) {
    echo '异常捕获';
    echo $e->getMessage();
}