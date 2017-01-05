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

class B extends Char
{
    public function color()
    {
        echo 'red';
    }
}

/**
 *通过test函数判断Char 类型实现多态
 * 什么是多态
 * 由java编程思想与php核心程序设计
 * 区分是否是多态的关键是看对象是否属于同一类型
 * 如果把它们看做同一类型,调用同一种函数返回不同的结果, 那么就是多态,否则不是多态
 * 总结
 * 多态指同一种对象在运行时的具体化
 * php是弱类型的实现多态更灵活
 * 类型转换不是多态
 * php中的父类和子类可以看做是继父和继子的关系 拥有继承关系但是没有血缘关系, 因此子类不能向上转型为父类,从而时区多态的最典型特征
 */
function test(Char $char)
{
    $char->color();
}

$a = new A();#对比java Char $a = new A();是否算是多态?
test($a);