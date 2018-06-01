<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/11
 * Time: 下午2:59
 */

if (!function_exists('event')) {
    function event($event,$eventData = false)
    {
        $dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
        $event = $eventData ? (new $event($eventData)) : (new $event);
        $dispatcher->addSubscriber($event->getListen());
        $dispatcher->dispatch($event::NAME,$event);
    }
}