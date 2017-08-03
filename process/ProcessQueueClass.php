<?php

class ProcessQueueClass
{
    protected $parent_id;

    protected $child_arr = [];

    protected $cpu_cores;

    public function __construct($cores = 0)
    {
        $this->cpu_cores = $cores ? $cores : substr(trim(exec('cat /proc/cpuinfo| grep "cpu cores"| uniq')), -1);
    }

    protected function createProgress($callback, array $param)
    {
        $pid = pcntl_fork();
        if ( $pid == -1) {
            // 创建失败
            throw new \Exception('fork progress error!');
        } else if ($pid == 0) {
            // 子进程执行程序
            $pid = posix_getpid();
            call_user_func_array($callback, $param);
            exit("({$pid})child progress end!\n");
        }else{
            // 父进程执行程序
            return $pid;
        }
    }

    public static function done($cores = 0, $callback, array $param)
    {
        while(!empty($childList)){
            $childPid = pcntl_wait($status);
            if ($childPid > 0){
                unset($childList[$childPid]);
            }
        }
    }

}