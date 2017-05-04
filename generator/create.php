<?php
/**
 * php 使用生成器实现 生产者消费者模型
 *
 * @return void
 */
function consumer()
{
    $r = '';
    while (1){
        echo 'gg'.PHP_EOL;
        $n = (yield $r); #yield时要再次执行到此处 才会返回迭代值
        if (!$n) {
            continue;
        }
        printf("[CONSUMER] Consuming %s...\n", $n);
        echo '暂停2s'.PHP_EOL;
        sleep(2);
        $r = "200 OK";
    }
}

function produce(\Generator $c)
{
    $n = 0;
    while ($n < 5) {
        $n = $n + 1;
        printf("[PRODUCER] Producing %s...\n", $n);
        $r = $c->send($n);
        printf("[PRODUCER] Consumer return: %s\n", $r);
    }
}
    
$c = consumer();
produce($c);