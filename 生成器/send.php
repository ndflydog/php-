<?php
function task() {
    #当第一次就用send(1)时 生成器不在yield 从这里开始执行
    for ($i = 1; $i <= 5; ++$i) {
        echo "This is task 1 iteration $i.\n";
        yield; #1作为yield的返回值然后继续执行！！所以如果不调用current() 直接第一次调用send()回出现 echo 两次结果
    }

}
$task = task();
$task->send(1);