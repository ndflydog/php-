<?php

echo 'tcp-test';

$time = time();
const LIMIT = 5;
set_time_limit(5);
$host = "127.0.0.1";
$port =3334;

// 创建一个tcp流
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)
    or die("socket_create() failed:" . socket_strerror(socket_last_error()));

echo "try to connect to $host:$port...\n";
$result = socket_connect($socket, $host, $port)
    or die("socket_connect() failed:" . socket_strerror(socket_last_error()));

$in = "hello world \n";
if (!socket_write($socket, $in, strlen($in))) {
    echo "socket_write() failed:" . socket_strerror($socket);
} else {
    echo "发送成功！\n";
}

$out = '';
while ($buf = socket_read($socket, 1024)) {
    $out .= $buf;    
    if ((time() - $time) > LIMIT || strlen($buf) < 1024) {
        break;
    }
}
echo "接受内容为：$out {".strlen($out)."}\n";

echo '时间'.(time() - $time).PHP_EOL;
socket_close($socket);

// try {
//     $fp = stream_socket_client("tcp://127.0.0.1:3334", $errno, $errstr, 5);
//     if (!$fp) {
//         echo "ERROR: $errno - $errstr<br />\n";
//     } else {
//         fwrite($fp, "hello world\n");
//         echo 'get';
//             $r = fread($fp);
//             var_dump($r);
//         fclose($fp);
//     }
// } catch (Exception $e) {
//     echo $e->getMesssage();
// }