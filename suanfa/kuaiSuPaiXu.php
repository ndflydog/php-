<?php
declare(ticks = 1);
$step = 0;
register_tick_function(function () use (&$step) {
    $step++;
});
$arr = [0, 2, 4, 5, 9, 8, 4, 3, 4, 5 ,6 ,7 ,8 ,88,80, 10, 28, 199];
function quickSort(&$arr){
    if(($_size = count($arr)) > 1){
        $k = $arr[0];
        $x = array();
        $y = array();
        for($i = 1; $i < $_size; $i++){
            if($arr[$i] <= $k){
                $x[] = $arr[$i];
            }elseif($arr[$i]>$k){
                $y[] = $arr[$i];
            }
        }
        $x=quickSort($x);
        $y=quickSort($y);
        return array_merge($x,array($k),$y);
    }else{
        return $arr;
    }
}

function quickC($start, $end, &$arr)
{
    if ($start >= $end) {
        return true;
    }
    $base = $arr[$start];
    $right = $end;
    $left = $start;

    while($right != $left) {
        while ($arr[$right] > $base && $left < $right) {
            $right--;
        }
        while ($arr[$left] <= $base && $left < $right) {
            $left++;
        }
        $tmp = $arr[$right];
        $arr[$right] = $arr[$left];
        $arr[$left] = $tmp; 
    }
    if ($right == $left) {
        $arr[$start] = $arr[$right];
        $arr[$right] = $base;        
    }
    quickC($start, $right - 1, $arr);
    quickC($right + 1, $end, $arr);
}

function maopao(&$arr)
{
    $length = count($arr);
    for ($i = 0; $i < $length - 1; $i++) {
        for ($j = 0; $j < $length - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j+1]) {
                $tmp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $tmp;
            }
        }
    }
}

function charu(&$arr)
{
    for($i=1;$i<count($arr);$i++){
        $tmp=$arr[$i];
        $key=$i-1;
        while($key>=0&&$tmp<$arr[$key]){
            $arr[$key+1]=$arr[$key];
            $key--;
        }
        if(($key+1)!=$i)
            $arr[$key+1]=$tmp;
    }
    return $arr;
}
//quickC(0, count($arr) - 1, $arr);
maopao($arr);
var_dump($arr);
echo $step;