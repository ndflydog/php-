<?php

set_time_limit(0);
$host = "127.0.0.1";
$port = 12388;

// 创建一个tcp流
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)
    or die("socket_create() failed:" . socket_strerror(socket_last_error()));

echo "try to connect to $host:$port...\n";
$result = socket_connect($socket, $host, $port)
    or die("socket_connect() failed:" . socket_strerror(socket_last_error()));

$in = "abc \n";
if (!socket_write($socket, $in, strlen($in))) {
    echo "socket_write() failed:" . socket_strerror($socket);
} else {
    echo "发送成功！\n";
}

$out = '';
while ($buf = socket_read($socket, 1024)) {
    $out .= $buf;
}
echo "接受内容为：$out \n";
socket_close($socket);
