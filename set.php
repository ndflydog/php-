<?php

class TestSet  {
    private $a;

    public function __get ($name) {
        echo '__get'.PHP_EOL;
        if($this->$name) {
            return $this->$name;
        }
    }

    public function __set ($name, $value) {
        echo '__set'.PHP_EOL;
        echo $name.PHP_EOL;
        echo $value.PHP_EOL;
        $this->$name = $value;
    }
}

$t = new TestSet();
$t->a = 1;
echo $t->a;