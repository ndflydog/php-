<?php
include './ServiceLoader.php';
include '../vendor/autoload.php';

class ServiceLocatorTest extends \PHPUnit_Framework_TestCase
{
    private $logService;

    private $databaseService;

    private $serviceLocator;

    public function setUp()
    {
        $this->serviceLocator = new ServiceLocator();
        $this->logService = new LogService();
        $this->databaseService = new DatabaseService();
    }

    public function testHasServices()
    {
        $this->serviceLocator->add('LogServiceInterface', $this->logService);
        $this->serviceLocator->add('DatabaseServiceInterface', $this->databaseService);
        
        $this->assertTrue($this->serviceLocator->has('LogServiceInterface'));
        $this->assertTrue($this->serviceLocator->has('DatabaseServiceInterface'));

        $this->assertFalse($this->serviceLocator->has('FakeServiceInterface'));
    }

    public function testServicesWithObject()
    {
        $this->serviceLocator->add('LogServiceInterface', $this->logService);
        $this->serviceLocator->add('DatabaseServiceInterface', $this->databaseService);

        $this->assertSame($this->logService, $this->serviceLocator->get('LogServiceInterface'));
        $this->assertSame($this->databaseService, $this->serviceLocator->get('DatabaseServiceInterface'));
    }

    public function testServiceWithClass()
    {
        $this->expectOutPutString('LogService');
        print get_class($this->logService);

        $this->assertFalse(is_object(get_class($this->logService)));

        $this->serviceLocator->add('LogServiceInterface', get_class($this->logService));
        $this->serviceLocator->add('DatabaseServiceInterface', get_class($this->databaseService));

        $this->assertNotSame($this->logService, $this->serviceLocator->get('LogServiceInterface'));
        $this->assertNotSame($this->databaseService, $this->serviceLocator->get('DatabaseServiceInterface'));

        $this->assertInstanceOf('DatabaseServiceInterface', $this->serviceLocator->get('DatabaseServiceInterface'));
        $this->assertInstanceOf('LogServiceInterface', $this->serviceLocator->get('LogServiceInterface'));
    }

    public function testServiceNotShared()
    {
        $this->serviceLocator->add('LogServiceInterface', $this->logService, false);
        $this->serviceLocator->add('DatabaseServiceInterface', $this->databaseService, false);

        $this->assertNotSame($this->logService, $this->serviceLocator->get('LogServiceInterface'));
        $this->assertNotSame($this->databaseService, $this->serviceLocator->get('DatabaseServiceInterface')); 
        
        $this->assertInstanceOf('DatabaseServiceInterface', $this->serviceLocator->get('DatabaseServiceInterface'));
        $this->assertInstanceOf('LogServiceInterface', $this->serviceLocator->get('LogServiceInterface'));
    }
}
