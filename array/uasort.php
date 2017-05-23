<?php
/**
 * 保持索引数值相同按id顺序
 * 
 **/

 $arr = [
     1,
     1,
     1,
 ];

 function cmp($a, $b) {
     if ($a = $b) {
         return 1;
     }
     return ($a < $b) ? -1 : 1;
 }

 uasort($arr, 'cmp');
 var_dump($arr);