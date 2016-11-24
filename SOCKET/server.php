<?php

set_time_limit(0);

$host = "127.0.0.1";
$port = 4000;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)
    or die("socket_create() failed:". socket_strerror(socket_last_error()));

//设置阻塞模式
socket_set_block($socket)
    or die("socket_set_block() failed:". socket_strerror(socket_last_error()));

// 绑定到端口
socket_bind($socket, $host, $port)
    or die("socket_bind() failed:" . socket_strerror(socket_last_error()));

// 开始监听
socket_listen($socket, 4)
    or die("socket_listen() failed:" . socket_strerror(socket_last_error()));

echo "Binding the socket on $host:$port ... \n";

while (true) {
    // 接收连接请求并调用一个子连接Socket来处理客户端和服务器间的信息
    if (($msgsock = socket_accept($socket)) < 0) {
        echo "socket_accept() failed:" . socket_strerror(socket_last_error());
    } else {
        // 读数据
        $out = '';
        while ($buf = socket_read($msgsock, 1024)) {
            if (!$buf) {
                break;
            }
            $out .= $buf;
            if (trim($buf) == "Shut") {
                break;
            }
            if (substr($buf, -1) == "\n") {
                break;
            }
        }

        // 写数据
        $in = "数据是 $out";
        echo $in;
        if (!socket_write($msgsock, $in, strlen($in))) echo "socket_write() failed:" . socket_strerror($socket);
    }
    // 结束通信
    socket_close($msgsock);
}
socket_close($socket);
