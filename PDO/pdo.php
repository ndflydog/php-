<?php

/**
 *测试pdo的连接是否会自动断开
 *实测连接数与查询数
 */

$dsn = "mysql:host=127.0.0.1;dbname=test";

try {
    $pdo = new PDO($dsn, 'root', '');
    for ($i = 0; $i < 10000; $i++) {
        $pdo_statement = $pdo->query("select * from fruit");
        $fruits = $pdo_statement->fetchAll();
        var_dump($fruits);
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
