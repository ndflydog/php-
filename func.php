<?php

function test (?int $a) :?int
{
    return $a;
}

echo test(null);