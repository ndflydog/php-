<?php
namespace pattern;

/**
 *观察着模式(发布/订阅模式)
 */

class User implements \SplSubject
{
    #user date
    protected $data = [];

    /**
     *观察着observers
     */
    protected $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    #附加观察着
    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    #解除观察者
    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    #通知观察着
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;

        $this->notify();
    }
}

class UserObserver implements \SplObserver
{
    public function update(\SplSubject $subject)
    {
        echo get_class($subject).' has been updated';
    }
}

// $observer = new UserObserver();
// $user = new User();
// $user->attach($observer);
// $user->name = 'hejinxue';
