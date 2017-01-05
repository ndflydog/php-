<?php
class Char
{
    public function color()
    {

    }
}

class A extends Char
{
    public function color()
    {
        echo 'red';
    }
}

function test(Char $char)
{
    $char->color();
}

$a = new A();#对比java Char $a = new A();是否算是多态?
test($a);