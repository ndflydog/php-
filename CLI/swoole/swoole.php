<?php

$serv = new Swoole\Server("127.0.0.1", 3334);
$serv->set(array(
    'worker_num' => 8,   //工作进程数量
    'daemonize' => false, //是否作为守护进程
));
$serv->on('connect', function ($serv, $fd){
    echo "Client:Connect.\n";
});
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $s = '';
    for ($i = 0; $i < 1000; $i++) {
		$s .= "Swoole";
	}
    echo $s."\n";
    $serv->send($fd, $s);
    $serv->close($fd);
});
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});
$serv->start();