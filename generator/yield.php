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
    $i = 0;
    while(true) {
        $string = (yield $i++);
    }
}

$printer = printer();
echo $printer->send('haha').PHP_EOL; //运行到yield并返回值
echo $printer->send('haha2').PHP_EOL; //运行到yield并返回值 send 也相当于调用了一次 next
echo $printer->current().PHP_EOL;
$printer->next().PHP_EOL;
echo $printer->current().PHP_EOL;
$printer->next().PHP_EOL;
echo $printer->current().PHP_EOL;
//echo $printer->send('hello world!');