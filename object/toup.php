<?php
class Base
{
    public function say()
    {
        echo 'I am base';
    }
}

class egg extends Base
{
    public function say()
    {
        echo 'I am egg';
    }
}

$a = new egg();