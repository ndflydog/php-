<?php

/**
 *测试pdo的连接是否会自动断开
 *实测连接数与查询数
 */

$dsn = "mysql:host=127.0.0.1;dbname=test";
echo '数据插入'.PHP_EOL;
$start = time();
try {
    $pdo = new \PDO($dsn, 'root', '');
    $value = '';
    $c = 0;
    for ($i = 0; $i < 1000000; $i++) {
        $tmp = 'haha'.$i;
        $c++;
        echo $tmp.PHP_EOL;
        $value .= strtr('(":tmp"),', [':tmp' => $tmp]);
        if ($c == 50000) {
            echo '插入'.PHP_EOL;
            $value = substr($value, 0, -1);    
            $pdo->exec("insert into user (test) values ".$value);
            $value = '';
            $c = 0;                          
        }
    }
    if ($c > 0) {
        $value = substr($value, 0, -1);
        $pdo->exec("insert into user (test) values ".$value);  
    }  
} catch (\Exception $e) {
    echo $e->getMessage();
}

echo time() - $start;