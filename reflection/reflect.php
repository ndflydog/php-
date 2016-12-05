<?php
#从反射中实例化对象

class Test
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

$class = new ReflectionClass(Test::class);
$instance = $class->newInstanceArgs(['he']);
var_dump($instance);