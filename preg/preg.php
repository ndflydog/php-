<?php
$a = '<a href="/www.baidu.com"></a><a href="/test"></a>';

#preg_match_all('#<a.*?href="([^\'"\s<>]+)"#i', $a, $matches);
preg_match_all('#<a.*?href=[\'"]*([^\'"\s<>]+)[\'"]*.*?>#i', $a, $matches);
#正则中的？改变任意字符.*为惰性匹配
var_dump($matches);
