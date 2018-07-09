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
function yar_pack($method, $params, $package = 'PHP')
{
    $request = [
        'i' => time(),
        'm' => $method,
        'p' => $params,
    ];
    $body = str_pad($package, 8, chr(0)) . ($package == 'PHP' ? serialize($request) : json_encode($request));
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
 * @param string $package PHP|JSON
 * @throws Exception
 * array [
 *        "i" => '', //time
 *        "s" => '', //status
 *        "r" => '', //return value
 *        "o" => '', //output
 *        "e" => '', //error or exception
 *    ]
 */
function yar_unpack($str, $package = 'PHP')
{
    $ret = $package == 'PHP' ? unserialize(substr($str, 82 + 8)) : json_decode(substr($str, 82 + 8), true);

    if ($ret['s'] === 0) {
        return $ret['r'];
    } elseif (is_array($ret)) {
        throw new Exception($ret['e']);
    } else {
        throw new Exception('malformed response header');
    }
}

$package = 'JSON';
$data  = yar_pack('getLastArr', [], $package);
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

echo substr($content, 82 + 8);
var_dump(yar_unpack($content, $package));