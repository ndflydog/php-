<?php
try {
    file_put_contents('/tmp/test.log', 1111111);
    $log_str = file_get_contents('/tmp/tj.log');
    $log_arr = explode('|', $log_str);
    $log_num = intval($log_arr[0]);
    $new_log_str = ($log_arr[0] + 1).'分享量|'.$log_arr[1].'|'.$log_arr[2].'|'.$log_arr[3].'|'.$log_arr[4];
    file_put_contents('/tmp/tj.log', $new_log_str);
}catch (\Exception $e) {
    file_put_contents('/tmp/test.log', $e->getMessage());
}