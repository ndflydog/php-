<?php

class Test  extends ArrayObject
{
    public $a = 1;
    public function __get($name) {
        echo 'gggggg';
        return 1;
    }
}

$array = array(
    array('name'=>'butch', 'sex'=>'m', 'breed'=>'boxer'),
    array('name'=>'fido', 'sex'=>'m', 'breed'=>'doberman'),
    array('name'=>'girly','sex'=>'f', 'breed'=>'poodle')
);

foreach(new RecursiveIteratorIterator(new RecursiveArrayIterator($array)) as $key=>$value)
    {
    echo $key.' -- '.$value.PHP_EOL;
    }
?>
