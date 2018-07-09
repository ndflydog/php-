<?php

$msg = '我是msg';

for ($i = 0; $i < 100; $i++) {
    $pid = pcntl_fork();
    if ( $pid == -1) {
        // 创建失败
        throw new \Exception('fork progress error!');
    } else if ($pid == 0) {
        // 子进程执行程序
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->auth(123456);
        $redis->select(4);
        $pid = posix_getpid();
        $redis->set('tmp'.$i, $msg);
        echo $pid.'我是message'.PHP_EOL;
        exit("({$pid})child progress end!\n");
    }else{
        // 父进程执行程序
    }
}