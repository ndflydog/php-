<?php

$handle = @fopen("./buffer.php", "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false){
        echo $buffer;
    }
    if (!feof($handle)) {
        echo "Error";
    }
    fclose($handle);
}
