<?php

class Bim
{
    public function doSth()
    {
        echo __METHOD__.PHP_EOL;
    }
}

class Bar
{
    protected $bim;

    public function __construct(Bim $bim)
    {
        $this->bim = $bim;
    }

    public function doSth()
    {
        $this->bim->doSth();
        echo __METHOD__.PHP_EOL;
    }
}

class Bar2 extends Bar
{
    protected $bim;

    public function doSth()
    {
        $this->bim->doSth();
        echo __METHOD__.PHP_EOL;
    }
}

class Foo
{
    private $bar;

    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }

    public function doSth()
    {
        $this->bar->doSth();
        echo __METHOD__.PHP_EOL;
    }
}

class Container
{
    private $s = [];

    public function __set($k, $c)
    {
        $this->s[$k] = $c;
    }

    public function __get($k)
    {
        return $this->s[$k]($this);
    }
}

class Container2
{
    private $s = [];

    public function __set($k, $c)
    {
        $this->s[$k] = $c;
    }

    public function __get($k)
    {
        if (!$this->s[$k]) {
            return false;
        }    
        return $this->build($this->s[$k]);
    }

    public function build($className)
    {
        if ($className instanceof Closure) {
            return $className($this);
        }

        try {
            $reflector = new ReflectionClass($className);
        } catch (\ReflectionException $e) {
            echo $className.'类反射异常'.PHP_EOL;
            echo $e->getMessage();
        }
        
        #检查类是否可实例化, 排除抽象类abstract和对象接口interface
        if (!$reflector->isInstantiable()) {
            throw new Exception("Can't instantiate this.");
        }

        $constructor = $reflector->getConstructor();
        
        #如果没有构造函数， 直接实例化并返回
        if (is_null($constructor)) {
            return new $className;
        }

        $parameters = $constructor->getParameters();

        #递归解析构造函数的参数
        $dependencies = $this->getDependencies($parameters);

        #创建一个类的新实例,给出的参数将传递到类的构造函数.
        return $reflector->newInstanceArgs($dependencies);
    }

    public function getDependencies($parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();

            if (is_null($dependency)) {
                $dependencies[] = $this->resolveNonClass($parameter);
            } else {
                #是一个类，递归解析
                $className = lcfirst($dependency->name);
                #先取出容器中绑定的类 否则自动绑定
                if ($this->s[$className]) {
                    $dependencies[] = $this->$className;                    
                } else {
                    $dependencies[] = $this->build($dependency->name);                                        
                }
            }
        }

        return $dependencies;
    }

    public function resolveNonClass($parameter)
    {
        // 有默认值则返回默认值
        if ($parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }
        throw new Exception('I have no idea what to do here.');
    }
}

// 依赖注入模式
//$foo = new Foo(new Bar(new Bim()));

#di模式
// $c = new Container();
// $c->bim = function() {
//     return new Bim();
// };
// $c->bar = function($c) {
//     return new Bar($c->bim);
// };
// $c->foo = function($c) {
//     return new Foo($c->bar);
// };

#实现了自动绑定
#1向di中注册类
$c = new Container2();
$c->bim = 'Bim';
#$c->bar = 'Bar2'; #实现了自动绑定 如果没有注册类的化就按自动加载去寻找类
$c->foo = 'Foo';
// $c->bar = 'Bar';
// $c->foo = function ($c) {
//     return new Foo($c->bar);
// };
// 从容器中取得Foo
$foo = $c->foo;
$foo->doSth();
