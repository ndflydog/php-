<?php

class A {
    public static function who() {
        echo get_called_class();
    }
    public static function test() {
        static::who(); // 后期静态绑定从这里开始
    }
}

class B extends A {
    public static function who() {
        echo get_called_class();
    }
}

A::test();
echo PHP_EOL;
B::test();
