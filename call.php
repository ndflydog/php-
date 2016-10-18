<?php

class TestCall
{
    public function __get($name) {
        $getter = 'get'.$name;
        echo $getter.PHP_EOL;
        $this->$getter();
    }

    public function getTest() {
        echo 'test';
    }
}

(new TestCall())->test;
