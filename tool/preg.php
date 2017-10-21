<?php
$a = '<a href="/www.baidu.com"></a><a href="/test"></a>';

#preg_match_all('#<a.*?href="([^\'"\s<>]+)"#i', $a, $matches);
preg_match_all('#<a.*?\shref=[\'"]*([^\'"\s<>]+)[\'"]*#i', $a, $matches);

var_dump($matches);
