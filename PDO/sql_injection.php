<html>
<head>
    <meta charset="utf-8" />
    <title>sql注入测试</title>
    <style>
        body{text-align:center}
    </style>
</head>
<body>
<br />
<?php
$dsn = "mysql:host=127.0.0.1;dbname=test";
$pdo = new PDO($dsn, 'root', '123456');
$id= $_GET['id'] ?? null;//id未经过滤
if($id == null){
    $id = 1;
}
$pdo->exec('set names utf8');
$sql = "SELECT * FROM test WHERE id = $id";
$stat = $pdo->prepare($sql);
$stat->execute();
$result = $stat->fetch();
$stat->closeCursor();

if (!$result){
    echo "该记录不存在";
    exit;
}
?>
<h4>sql注入测试</h4>
<table border='2'  align="center">
    <tr>
        <td>id:<?php echo $id;?></td>
    </tr>
    <tr>
        <td>标题:<?php echo $result['title'];?></td>
    </tr>
    <tr>
        <td>内容:<?php echo $result['content'];?></td>
    </tr>
    <tr>
        <td>sql内容: <?php echo $sql;?></td>
    </tr>
</table>
</body>
</html>
