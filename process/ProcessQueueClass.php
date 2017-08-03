<?php

class ProcessQueueClass
{
    protected $parent_id;

    protected $child_arr = [];

    protected $cpu_cores;

    protected $callback;

    protected $msgQueue;

    public function __construct($cores = 0)
    {
        $this->cpu_cores = $cores ? $cores : substr(trim(exec('cat /proc/cpuinfo| grep "cpu cores"| uniq')), -1);
        $id = ftok(__FILE__,'m');
        $this->msgQueue = msg_get_queue($id);
    }

    protected function createProgress()
    {
        $pid = pcntl_fork();
        if ( $pid == -1) {
            // 创建失败
            throw new \Exception('fork progress error!');
        } else if ($pid == 0) {
            // 子进程执行程序
            $pid = posix_getpid();
            $this->work();
            exit("({$pid})child progress end!\n");
        }else{
            // 父进程执行程序
            return $pid;
        }
    }

    public function done()
    {
        for ($i = 0; $i < $this->cpu_cores; $i++) {
            $pid = $this->createProgress();
            $this->child_arr[$pid] = 1;
        }
        while(!empty($this->child_arr)){
            $childPid = pcntl_wait($status);
            if ($childPid > 0){
                unset($this->child_arr[$childPid]);
            }
        }

        return $this->finish();
    }

    #覆盖此方法
    public function work()
    {
        $arr = [1,2,3,4,5,6,7,8,9];
        $pid = posix_getpid();
        $sum = array_sum($arr);
        echo "$pid 进程计算的值为$sum".PHP_EOL;
        msg_send($this->msgQueue, 1, $sum);
    }

    #结束方法
    public function finish()
    {
        $sum = 0;
        while (1) {
            $msgType = '';
            msg_receive($this->msgQueue, 1, $msgType, 1024,$message, true, MSG_IPC_NOWAIT);
            if (!$message) break;
            $sum += $message;
        }
        return $sum;
    }

    public function __destroy()
    {
        msg_remove_queue($this->msgQueue);
    }
}

echo (new ProcessQueueClass())->done();