<?php

#依赖注入模式

abstract class AbstractConfig
{
    protected $storage;

    public function __construct($storage)
    {
        $this->storage = $storage;
    }
}

interface Parameters
{
    public function get($key);

    public function set($key, $value);
}

class ArrayConfig extends AbstractConfig implements Parameters
{
    public function get($key, $default = null) 
    {
        if (isset($this->storage[$key])) {
            return $this->storage[$key];
        }
        return $default;
    }

    public function set($key, $value)
    {
        $this->storage[$key] = $value;
    }
}

class Connection
{
    protected $configuration;

    protected $host;

    #connection类依赖Parameters类实现一些服务，但是不在Connection类中取 new Parameters
    #在connection类的外部去实例化Paramerets实现控制反转
    public function __construct(Parameters $config)
    {
        $this->configuration = $config;
    }

    public function connect()
    {
        $host = $this->configuration->get('host');

        $this->host = $host;
    }

    public function getHost()
    {
        return $this->host;
    }
}