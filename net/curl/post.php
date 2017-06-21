<?php

function curl($url,$posts=""){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, $posts ? 0 : 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$posts);
    $icerik = curl_exec($ch);
    curl_close($ch);
    return $icerik;
}
$posts = [
    'username'=> 'nishiyi6666',
    'email' => 'hejsfafa@163.com',
    'password' => 'hejinxue',
    'password2' => 'hejinxue'
];
var_dump(curl('http://bbs.waiplay.com/reg_api.php?inajax=1', $posts));