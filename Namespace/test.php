<?php
namespace NamespaceTest;

class Test
{
    public function index()
    {
        echo __CLASS__;//输出的类名是会带上命名空间的
    }
}

(new Test)->index();