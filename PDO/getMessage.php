<?php

$dsn = "mysql:host=127.0.0.1;dbname=test";
try {
    $pdo = new \PDO($dsn, 'root', '');
    $ste = $pdo->prepare("select * from  trusted_list");
    $ste->execute();
    $data = $ste->fetchAll();
    var_dump($data);
} catch (\Exception $e) {
    echo $e->getMessage();
}