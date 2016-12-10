<?php
$arr = [0, 2, 4, 5, 9, 8, 4];
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
$t = quickSort($arr);
var_dump($t);