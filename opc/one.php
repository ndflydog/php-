<?php

session_start();
if($_SESSION['a']) {
    $_SESSION['a'] = 0;    
    echo '我是one<br>';
    include 'two.php';
} else {
    $_SESSION['a'] = 1;
    echo '我是one2<br>';
    include 'three.php';    
}
