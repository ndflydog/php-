<?php

$fruits = [
    ['apple', 'red'],
    ['banana', 'yellow'],
    ['watermelon', 'green']
];

try {
    $con = new PDO('mysql:dbname=test;host=127.0.0.1', "root", "");
    // foreach ($fruits as $fruit) {
    //     $con->exec("insert into fruit (name, color) values ('".$fruit[0]."', '".$fruit[1]."')");
    // }
    $fruits = $con->query("select * from fruit");
    $fruits->bindColumn('name', $name);
    $fruits->bindColumn('color', $color);

    while ($fruits->fetch(PDO::FETCH_BOUND)) {
        echo $name.' is '.$color.PHP_EOL;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
