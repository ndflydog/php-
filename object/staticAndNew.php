<?php
ini_set('memory_limit', '1024M');
class TestStatic 
{
    public static function test()
    {

    }
}

class TestNew
{
    public function test()
    {

    }
}

$count = 1000;
$start = microtime();
for ($i = 0; $i < $count; $i++) {
    (new TestNew)->test();
}
$end = microtime();
echo $end - $start;
echo PHP_EOL;

$start = microtime();
for ($i = 0; $i < $count; $i++) {
    TestStatic::test();
}
$end = microtime();
echo $end - $start;
