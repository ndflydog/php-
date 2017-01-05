<?php
/**
 *php中的接口不能起到契约的作用
 *php中的接口只判断函数是否被实现 而不管语义是否正确
 *按理说接口应该起到是强制规范和契约作用 摘自php核心技术与最佳实践
 */
interface Cache
{
    public function set();
    public function get();
}

class FileCache implements Cache
{
    public function set()
    {
        echo 'file cache set';
    }

    public function get()
    {
        echo 'file cache get';
    }

    public function test() 
    {
        echo '不应该成功!';
    }
}

$fileCache = new FileCache();
function test (Cache $cache)
{
    $cache->test();   #Cache接口并没有起到应该有的契约作用
}
test($fileCache);