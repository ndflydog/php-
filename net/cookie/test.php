<?php
session_start();
if ($_COOKIE['test'] == 1) {
    header('Location:redirect.php');
    //unset($_COOKIE['test']);
    //setcookie('test', '', time()-36000, '/');
}else 
    setcookie('test', 1, time()+36000, '/');
echo 'hello world';
?>