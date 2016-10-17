<?php

echo str_repeat(' ', 4096);
ob_implicit_flush();
for ($i = 0; $i < 10; $i++)
{
    echo "$i\n";
    ob_implicit_flush();
    sleep(1);
}
