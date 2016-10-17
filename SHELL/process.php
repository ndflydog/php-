<?php

/**
 *php exec执行shell命令
 *问题 服务器上的redis有时会出现问题异常退出 用php shell检测如果连接不到redis就重启
 */

 $output = [];
 $return_var;
 exec('redis-server /etc/redis.conf', $output, $return_var);
 var_dump($output);