<?php
// function xrage($start, $end, $stop = 1)
// {
//     for ($i = $start; $i <= $end; $i += $stop) {
//         yield $i;
//     }
// }

// $y = xrage(1, 10);
// while($y->valid()) {
//     echo $y->current();
//     $y->next();
//     echo PHP_EOL;
// }
// echo 1111;
// echo $y->current();
function printer()
{
    while(true) {
        $string = (yield 1);
        echo 'gg'.$string.PHP_EOL;
    }
}

$printer = printer();
$printer->send('haha');
echo $printer->current();
$printer->next();
echo $printer->current();
$printer->next();
echo $printer->current();
//echo $printer->send('hello world!');