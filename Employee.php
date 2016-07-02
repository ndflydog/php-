<?php

abstract class Employee {
    protected $name;
    private static $types = array('minion', 'cluedup', 'wellconnected');

    static function recruit ($name) {
        $num = rand(1, count(self::$types)) - 1;
        $class = self::$types[$num];
        return new $class($name);
    }

    function __construct($name) {
        $this->name = $name;
    }

    abstract function fire();
}

class WellConnected extends Employee {
    function fire() {
        print "{$this->name}: I'll call my dad\n";
    }
}