<?php
 
class Test {
}
 
function a($i) {
    b(new Test, 2.3432, "reader");
}
function b($i) {
    c(array(1,2,3));
}
function c($i) {
    d(TRUE);
}
function d($i) {
    $fp = fopen("/tmp/1.php", "r");
    e($fp);
}
 
function e($i) {
    sleep(1000);
}
 
a();