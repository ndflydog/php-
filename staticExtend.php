<?php

class A {
  public static $a = 1.__CLASS__;
}

class B extends A {
  public static function test () {
    if(self::$a) {
      echo 'ggg';
    }
  }
}

B::test();
