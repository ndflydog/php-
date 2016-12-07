<?php
/*
设置使用set_error_handler()函数接管php自身的错误处理机制以后，以后发生错误以后，就会
直接调用set_error_handler()中指定的回调函数。并将错误相关的信息，比如说错误行号，文件
名等信息传递到该回调函数。设置set_error_handler()函数以后，原先使用的@这个屏蔽错误的
语法糖就失去了作用
set_error_handler()函数并不会接管所有的错误,Fatal_error, Parse_error等错误类型该
函数是接管不了的。Parse_error是解析错误，是php解释器解释阶段发生的错误，我们是不可能接管
这个错误的。对于致命错误，我们可以通过register_shutdown_function()函数来进行处理。需要
注意的是，这个函数并不能提我们接管错误信息，而是在程序彻底"死掉"之前，执行一下器指定的回调
函数。有点类似与php类中的析构函数。
*/
function error_handler($errno, $errstr, $errfile, $errlime)
{
    echo '错误捕获';
    #写入日志  
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
    @fopen('/tmp/ttttt.log', 'r');    #php老旧函数直接抛出错误 不能用try catch 异常捕获
} catch (\Exception $e) {
    echo '异常捕获';
    echo $e->getMessage();
}