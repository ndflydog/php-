<?php
#php多进制计算大数组

$parentPid = posix_getpid();
echo "parent progress pid:{$parentPid}".PHP_EOL;$childList = [];
// 创建消息队列,以及定义消息类型(类似于数据库中的库)
$id = ftok(__FILE__,'m');
$msgQueue = msg_get_queue($id);
const MSG_TYPE = 1;

function createProgress($callback, $arr)
{
    $pid = pcntl_fork();
    if ( $pid == -1) {
        // 创建失败
        exit("fork progress error!\n");
    } else if ($pid == 0) {
        // 子进程执行程序
        $pid = posix_getpid();
        $callback($arr);
        exit("({$pid})child progress end!\n");
    }else{
        // 父进程执行程序
        return $pid;
    }
}
$arr = [1,2,3,4,5,6,7,8,9];

function sum(array $arr)
{
    global $msgQueue;
    $pid = posix_getpid();
    $sum = array_sum($arr);
    echo "$pid 进程计算的值为$sum".PHP_EOL;
    msg_send($msgQueue, MSG_TYPE, $sum);
}

for ($i = 0; $i < 2; $i ++ ) {
    $pid = createProgress('sum', $arr);
    $childList[$pid] = 1;
    echo "create sum child progress: {$pid} \n";
}
// 等待所有子进程结束
while(!empty($childList)){
    $childPid = pcntl_wait($status);
    if ($childPid > 0){
        unset($childList[$childPid]);
    }
}
$sum = 0;
while (1) {
    msg_receive($msgQueue,MSG_TYPE,$msgType,1024,$message, true, MSG_IPC_NOWAIT);
    if (!$message) break;
    $sum += $message;
}
echo "({$parentPid})main progress end!".PHP_EOL;
echo "计算结果为$sum".PHP_EOL;