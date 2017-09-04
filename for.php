<?php

$time = time();

for ($i = 0; $i < 100000000; $i++){}

echo time() - $time;