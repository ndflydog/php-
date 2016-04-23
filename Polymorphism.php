<?php

/**
 * 多态
 */

abstract class Employee {
    protected $name;
    function __construct ($name) {
        $this->name = $name;
    }
    abstract function fire();
}

/**
 * 面向接口编程；使用多态
 */
class Minion extends Employee {
    function fire() {
        print "{$this->name}: I'll clear my desk\n";
    }
}

class CluedUp extends Employee {
    function fire() {
        print "{$this->name}: I'll call my lawyer\n";
    }
}

/**
 * 
 */
class NastyBoss {
    private $employees = array();

    function addEmployee (Employee $employee) {
        $this->employees[] = $employee;
    }

    function projectFails() {
        if (count ($this->employees)) {
            $emp = array_pop( $this->employees );
            $emp->fire();
        }
    }
}

/**
 * 虽然这个版本的类能与Employee类型一起工作，而且也能从多态中获益，但我们仍旧没有定义创建对象的策略.
 */
$boss = new NastyBoss();
$boss->addEmployee( new Minion('harry'));
$boss->addEmployee( new CluedUp('bob'));
$boss->addEmployee( new Minion('mary'));
$boss->projectFails();
$boss->projectFails();
$boss->projectFails();