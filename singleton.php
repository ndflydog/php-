<?php

/**
 * 单例模式实现
 */

#创建一个无法从其自身外部来创建实例的类
#使用静态方法和静态属性来间接实例化对象


#单例模式是一种对于全局变量的改进。
class Preferences {
    private $props = array();
    private static $instance;

    public static function getInstance () {
        if (empty(self::$instance)) {
            self::$instance = new Preferences();
        }
        return self::$instance;
    }

    public function setProperty($key, $val) {
        $this->props[$key] = $val;
    }

    public function getProperty($key) {
        return $this->props[$key];
    }
}

$pref = Preferences::getInstance();
$pref->setProperty("name", "matt");

unset($pref);

$pref2 = Preferences::getInstance();
print $pref2->getProperty("name")."\n";//该属性并没有丢失