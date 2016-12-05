<?php

class Foo
{
    var $that;

    function __clone()
    {
        $this->that = clone $this->that;
    }
}

$a = new Foo;
$b = new Foo;
$a->that = $b;
$b->that = $a;

$c = clone $a;
echo 'What happened?';
var_dump($c);