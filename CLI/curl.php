<?php
$url = 'http://www.lonlife.cn/user/hallowmasRegister';
		$data = [
			'username' => $_GPC['username'],
			'password' => $_GPC['password'],
		];
$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$res = curl_exec($ch);
		curl_close($ch);
		var_dump($res);