<?php

#服务容器接口
interface ServiceLocatorInterface
{
    /**
     *检测 一个 服务是否被注册
     */
    public function has($interface);

     /**
      *获取服务注册对接口
      */
    public function get($interface);
}

class ServiceLocator implements ServiceLocatorInterface
{
    #所有服务
    private $services;

    #服务的实例
    private $instantiated;

    #服务是否能被共享
    private $shared;

    public function __construct()
    {
        $this->services = [];
        $this->instantiated = [];
        $this->shared = [];
    }

    #注册一个服务绑定特定的接口
    public function add($interface, $service, $share = true)
    {
        if (is_object($service) && $share) {
            $this->instantiated[$interface] = $service;
        }

        $this->services[$interface] = (is_object($service) ? get_class($service) : $service);
        $this->shared[$interface] = $share;
    }

    #检测一个服务是否被注册
    public function has($interface)
    {
        return (isset($this->services[$interface]) || isset($this->instantiated[$interface]));
    }

    public function get($interface)
    {
        if (isset($this->instantiated[$interface]) && $this->shared[$interface]) {
            return $this->instantiated[$interface];
        }

        $service = $this->services[$interface];

        $object = new $service();

        if ($this->shared[$interface]) {
            $this->instantiated[$interface] = $object;
        }
        return $object;
    }
}

interface LogServiceInterface
{
}

class LogService implements LogServiceInterface
{
}

interface DatabaseServiceInterface
{
}

class DatabaseService implements DatabaseServiceInterface
{
}
