<?php

$postdata = http_build_query(
    array(
        'var1' => 'some content',
        'var2' => 'doh'
    )
);

$opts = array('http' =>
    array(
        'method'  => 'GET',
        'timeout' => 3
    )
);

$context = stream_context_create($opts);

$result = file_get_contents('http://www.hejinxue.top/test.php', false, $context);

echo $result;

?>