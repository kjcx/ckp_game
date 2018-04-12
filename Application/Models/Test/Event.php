<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/12
 * Time: 上午12:03
 */
namespace App\Models\Test;
use App\Event\BookSubscriber;
use Symfony\Component\EventDispatcher\EventDispatcher;

class Event
{
    private $dispatcher;
    public function __construct()
    {
        $dispatcher = new EventDispatcher();
        $subscriber = new BookSubscriber();
        $dispatcher->addSubscriber($subscriber);
        $this->dispatcher = $dispatcher;
    }
    function t($name){
        $this->dispatcher->dispatch($name);
    }
}