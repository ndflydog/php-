<?php
#使用事务 如果出错则回滚事务

$dsn = 'mysql:dbname=test;host=127.0.0.1';
$user = 'root';
$password = '';

try {
	$db = new PDO($dsn, $user, $password);
}catch (PDOException $e){
	echo $e->getMessage();
}

$db->beginTransaction();

$sth = $db->exec('drop table transaction');

$db->commit();
