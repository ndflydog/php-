<?php


/*
 * 82字节
typedef struct _yar_header {
    unsigned int   id;            // transaction id
    unsigned short version;       // protocl version
    unsigned int   magic_num;     // default is: 0x80DFEC60
    unsigned int   reserved;
    unsigned char  provider[32];  // reqeust from who
    unsigned char  token[32];     // request token, used for authentication
    unsigned int   body_len;      // request body len
}
*/
function yar_php_pack($method, $params)
{
    $request = [
        'i' => time(),
        'm' => $method,
        'p' => $params,
    ];
    $body = str_pad('PHP', 8, chr(0)) . serialize($request);
    $transaction = sprintf('%08x', mt_rand());
    $header = $transaction; //transaction id
    $header .= sprintf('%04x', 0); //protocl version
    $header .= '80DFEC60'; //magic_num, default is: 0x80DFEC60
    $header .= sprintf('%08x', 0); //reserved
    $header .= sprintf('%064x', 0); //reqeust from who
    $header .= sprintf('%064x', 0); //request token, used for authentication
    $header .= sprintf('%08x', strlen($body)); //request body len
    $data = '';

    for ($i = 0; $i < strlen($header); $i = $i + 2) {
        $data .= chr(hexdec('0x' . $header[$i] . $header[$i + 1]));
    }

    $data .= $body;
    return $data;
}

/**
 * @param string $str
 * @throws Exception
 * array [
 *        "i" => '', //time
 *        "s" => '', //status
 *        "r" => '', //return value
 *        "o" => '', //output
 *        "e" => '', //error or exception
 *    ]
 */
function yar_php_unpack($str)
{
    $ret = unserialize(substr($str, 82 + 8));

    if ($ret['s'] === 0) {
        return $ret['r'];
    } elseif (is_array($ret)) {
        throw new Exception($ret['e']);
    } else {
        throw new Exception('malformed response header');
    }
}

$data  = yar_php_pack('getLastArr', []);
$url = 'http://t.lonlife.cn:9300/common/services/userService';

$ch = curl_init();
$opt = [];
$opt[CURLOPT_URL] = $url;
$opt[CURLOPT_HEADER] = 0;
$opt[CURLOPT_RETURNTRANSFER] = 1;
$opt[CURLOPT_POST] = 1;
$opt[CURLOPT_POSTFIELDS] = $data;
curl_setopt_array($ch, $opt);
$content = curl_exec($ch);
$curl_info = curl_getinfo($ch);
curl_close($ch);

if (200 != $curl_info['http_code']) {
    die($curl_info);
}

var_dump(yar_php_unpack($content));