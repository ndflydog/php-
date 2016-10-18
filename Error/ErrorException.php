<?php
function onError($errCode, $errMesg, $errFile, $errLine) {
    echo "Error Occurred\n";
    throw new Exception($errMesg);
}
 
function onException($e) {
    echo 'Exception Occurred\n';
    echo $e->getMessage();
}
 
set_error_handler("onError");
 
set_exception_handler("onException");
 
/* 我从不会以我的名字命名文件, 所以这个文件不存在 */
require("laruence.php");