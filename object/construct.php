<?php

class Test
{
    public function __construct()
    {
        echo '我是构造函数我可以通过类名调用--但是只能是在我的子类的构造函数中';
    }
}

class Test2 extends Test
{
    public function __construct()
    {
        Test::__construct();
    }
}

new Test2();