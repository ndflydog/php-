<?php
include './autoload.php';
include '../vendor/autoload.php';

use pattern\User;
use pattern\UserObserver;

#对观察着模式进行单元测试
class observeTest extends \PHPUnit_Framework_TestCase
{
    protected $observer;

    protected function setUp()
    {
        $this->observer = new UserObserver();
    }

    #测试通知
    public function testNotify()
    {
        $this->expectOutPutString('pattern\User has been updated');
        $subject = new User();

        $subject->attach($this->observer);
        $subject->property = 123;
    }

    #测试订阅
    public function testAttachDetach()
    {
        $subject = new User();
        $reflection = new \ReflectionProperty($subject, 'observers');

        $reflection->setAccessible(true);
        $observers = $reflection->getValue($subject);

        $this->assertInstanceOf('SplObjectStorage', $observers);
        $this->assertFalse($observers->contains($this->observer));

        $subject->attach($this->observer);
        $this->assertTrue($observers->contains($this->observer));

        $subject->detach($this->observer);
        $this->assertFalse($observers->contains($this->observer));
    }

    #测试update调用
    public function testUpdateCalling()
    {
        $subject = new User();
        $observer = $this->getMock('SplObserver');
        $subject->attach($observer);

        $observer->expects($this->once())
            ->method('update')
            ->with($subject);
        $subject->notify();
    }
}
#phpunit observeTest.php  执行单元测试
