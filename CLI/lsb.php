<?php
#使用 self:: 或者 __CLASS__ 对当前类的静态引用，取决于定义当前方法所在的类：
/*
    后期静态绑定本想通过引入一个新的关键字表示运行时最初调用的类来绕过限制。
    简单地说，这个关键字能够让你在上述例子中调用 test() 时引用的类是 B 而不是 A。最终决定不引入新的关键字，
    而是使用已经预留的 static 关键字。
*/
class A {
    public static function foo() {
        static::who();
    }

    public static function who() {
        echo __CLASS__."\n";
    }
}

class B extends A {
    public static function test() {
        A::foo();
        parent::foo();
        self::foo();
    }

    public static function who() {
        echo __CLASS__."\n";
    }
}
class C extends B {
    public static function who() {
        echo __CLASS__."\n";
    }
}
C::test();
#A,
#C,
#C
/*
    首先C::test()，进入test方法，A::foo()、parent::foo()、self::foo()这三个方法调用的“上一次

非转发调用”存储的类名就是C啦。

通过A::foo()进入foo方法时，“上一次非转发调用”存储的类名就变成A啦。所以static::实际上代表A::。

通过parent::foo()进入foo方法时，“上一次非转发调用”存储的类名还是C。所以static::代表C::。

通过self::foo()进入foo方法时，“上一次非转发调用”存储的类名还是C。所以static::代表C::。

注意这里之所以会触发lsb是因为foo()方法中的static::用法。
如果这里的static::who()改为self::who()，则不会出lsb，也就没有“上一次非转发调用”存储的类名这个概念了，实际上就是A::who()
*/