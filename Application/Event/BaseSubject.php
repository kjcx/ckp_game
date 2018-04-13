<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/10
 * Time: 下午3:07
 * 观察者主体
 */

namespace App\Event;

trait BaseSubject
{

    private $observers;

    public function detach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}