<?php

echo 'tcp-test';

try {
    $fp = stream_socket_client("tcp://127.0.0.1:3334", $errno, $errstr, 5);
    if (!$fp) {
        echo "ERROR: $errno - $errstr<br />\n";
    } else {
        fwrite($fp, "hello world\n");
        echo 'get';
            $r = fread($fp);
            var_dump($r);
        fclose($fp);
    }
} catch (Exception $e) {
    echo $e->getMesssage();
}