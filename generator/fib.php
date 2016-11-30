<?php

function fib($num){
    if($num < 1){
        return -1;
    }
    $arr[0] = 0;
    $arr[1] = 1;
    for ($i = 2; $i < $num ; $i++) { 
        $arr[$i] = $arr[$i-1]+$arr[$i-2];
    }
    return implode(',', $arr);
}

function recursion($num){
            //判断是否小于0
            if($num<0){
                    return -1;
            }
            if($num==1){
                return 0;
            }
            if($num==2 || $num==3){
                return 1;
            }
            return recursion($num-1)+recursion($num-2);
        }
        //循环显示         
        for($i=1;$i<=20;$i++) {
                $str .= ',',recursion($i);
        }    
        $str = substr($str,1);
        echo $str;
echo fib(6);