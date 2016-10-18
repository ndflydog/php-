<?php

/**
 *测试pdo的连接是否会自动断开
 *实测连接数与查询数
 */

$dsn = "mysql:host=127.0.0.1;dbname=test";
echo '数据插入'.PHP_EOL;
try {
    $pdo = new \PDO($dsn, 'root', '');
    for ($i = 0; $i < 100; $i++) {
        $tmp = 'haha'.$i;
        $pdo->exec("insert into test (name) values ('".$tmp."');");
    }
    echo 1;
} catch (\Exception $e) {
    echo $e->getMessage();
}