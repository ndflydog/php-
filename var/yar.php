<?php

$client = new Yar_Client("http://www.hejinxue.top/api.php");
$result = $client->api("parameter");
echo $result;
