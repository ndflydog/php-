<?php

class A
{
    public static $a = 1;

    public static function get()
    {
        echo static::$a;
    }
}