<?php

$fname = './MMLDZG.mp3';
$fp = fopen($fname,'rb');
$fsize = filesize($fname);
if (isset($_SERVER['HTTP_RANGE']) && ($_SERVER['HTTP_RANGE'] != "") && preg_match("/^bytes=([0-9]+)-$/i", $_SERVER['HTTP_RANGE'], $match) && ($match[1] < $fsize)) {    
  $start = $match[1]; 
} else {     
  $start = 0; 
} 

@header("Cache-control: public"); 
@header("Pragma: public"); 

if ($start-- > 0) {
    fseek($fp, $start);
    Header("HTTP/1.1 206 Partial Content");
    Header("Content-Length: " . ($fsize - $start));
    Header("Content-Ranges: bytes" . $start . "-" . ($fsize - 1) . "/" . $fsize);
} else {
    header("Content-Length: $fsize");
    Header("Accept-Ranges: bytes");
}
@header("Content-Type: application/octet-stream");
@header("Content-Disposition: attachment;filename=mmdld.mp3");
fpassthru($fp);
fpassthru();//函数输出文件指针处的所有剩余数据。

#该函数将给定的文件指针从当前的位置读取到 EOF，并把结果写到输出缓冲区。