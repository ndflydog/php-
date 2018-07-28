<?php

class A {
    public $a = 1;
}

$a = new A();

function test($a)
{
    $a = 1;
    return $a;
}

var_dump($a);
var_dump(test($a));