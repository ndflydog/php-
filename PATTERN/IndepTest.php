<?php

include "Indep.php";
include "../vendor/autoload.php";

class IndepTest extends \PHPUnit_Framework_TestCase
{
    protected $config;
    protected $source;

    public function setUp()
    {
        $this->source = include "config.php";
        $this->config = new ArrayConfig($this->source);
    }

    public function testDependencyInjection()
    {
        #在类的外部去初始化Paramers类实现控制反转
        $connection = new Connection($this->config);
        $connection->connect();
        $this->assertEquals($this->source['host'], $connection->getHost());
    }
}