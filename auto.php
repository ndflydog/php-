<?php
#自动提交
$dsn = 'mysql:dbname=test;host=127.0.0.1';
$user = 'root';
$password = '';

try {
	$dbh = new PDO($dsn, $user, $password);
} catch (Exception $e) {
	die("Unable to connect: " . $e->getMessage());
}

try {
	#$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	#$dbh->beginTransaction();
	$dbh->exec("insert into test  values (23, 33)");
	$dbh->exec("insert into test2  
		values (50000, 2222)");
	#$dbh->commit();

} catch (Exception $e) {
	#$dbh->rollBack();
	echo 'err'.$e->getMessage();
}


