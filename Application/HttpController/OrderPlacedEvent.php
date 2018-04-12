<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/11
 * Time: 下午10:58
 */
namespace Acme\Store\Event;

use Symfony\Component\EventDispatcher\Event;
use Acme\Store\Order;

/**
 * The order.placed event is dispatched each time an order is created
 * in the system.
 */
class OrderPlacedEvent extends Event
{
    const NAME = 'order.placed';

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function getOrder()
    {
        return $this->order;
    }
}