<?php
 class Foo {
     public function bar() {
         var_dump($this);
     }
 }
 class A {
     public function test() {
         Foo::bar();
     }
 }
 $a  = new A();
 $a->test();
