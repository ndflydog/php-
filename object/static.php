<?php

/**
 *静态变量是是属于类的只能通过类来访问
 */
class Base
{
    public static $a ;

    public function set($a)
    {
        Base::$a  = $a;
    }

    public function get()
    {
        return Base::$a;
    }
}

$t = new Base();
$t->set(2);

echo Base::$a;