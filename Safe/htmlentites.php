<?php

#如果不用htmlentities();进行把html标签转换为字符串 html标签会被浏览器直接执行
$str = '<script>alert(1)</script>';
echo htmlentities($str);
echo htmlspecialchars($str);
echo html_entity_decode(htmlentities($str));

echo "&lt gggggg &gt";
