<?php
$url = 'http://php.net/manual/en/langref.php';

$content = file_get_contents($url);

$matches= '';

$num = preg_match_all('#<dt>(.*?)</dt>#', $content, $matches);

var_dump($matches);