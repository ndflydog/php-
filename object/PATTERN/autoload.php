<?php

#自动加载同一命名空间下的文件
function my_autoloader($class)
{
    include './observe.php';
}
spl_autoload_register(my_autoloader);
