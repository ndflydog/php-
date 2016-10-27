<?php

interface AI
{
    public function doSome();
}

class a implements AI
{
    public function doSome()
    {
        echo __CLASS__.'do'.PHP_EOL;
    }
}

class b implements AI
{
    public function doSome()
    {
        echo __CLASS__.'do'.PHP_EOL;
    }
}

function Test(AI $test) {
    $test->doSome();
}

$a = new a();
$b = new b();
Test($a);
Test($b);