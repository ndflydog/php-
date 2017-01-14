<?php
/**
 *php中的接口不能起到契约的作用
 *php中的接口只判断函数是否被实现 而不管语义是否正确
 *按理说接口应该起到是强制规范和契约作用 摘自php核心技术与最佳实践
 *接口总结
 *接口作为一种规范和契约存在.作为规范,接口应该保证可用性;作为契约,接口应该保证可控性
 *接口只是一个声明,一旦使用interface关键字,就应该实现它.可以由程序元实现(外部接口),
 *也可以由系统实现(内部接口).接口本身都不做,但是它可以告诉我们它能做什么
 *php中的接口存在两个不足,一是没有契约限制,二是缺少足够多的内部接口
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
