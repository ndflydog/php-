<?php

session_start();
if ($_COOKIE['test'] == 1) {
    echo $_COOKIE[test];
    unset($_COOKIE['test']);
    setcookie('test', '', time()-36000, '/');
} else {
    echo 2222;
}