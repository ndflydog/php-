<?php

$str = "select * from test a = '1'";
echo addslashes($str);#对字符串中的''进行添加斜杠转义
echo '<br/>';
echo stripslashes(addslashes($str));
$str2 = 'select * from test a = '.'1';
echo addslashes($str2);
