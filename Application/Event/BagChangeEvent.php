<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/29
 * Time: 上午10:04
 */

namespace App\Event;

use App\Listen\BagChangeListen;
use Symfony\Component\EventDispatcher\Event;

class BagChangeEvent extends Event
{
    protected $listen = BagChangeListen::class;
    const NAME = 'bag.change';

    public function __construct($uid)
    {
        $this->setUid($uid);
    }

    public function getListen()
    {
        return (new $this->listen);
    }
}