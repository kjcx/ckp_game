<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/28
 * Time: 下午2:24
 */

namespace App\Event;

use App\Listen\RoleCreateListen;
use App\Traits\UserTrait;
use Symfony\Component\EventDispatcher\Event;

class RoleCreateEvent extends Event
{
    use UserTrait;

    const NAME = 'role.create';

    protected $listen = RoleCreateListen::class;

    public function __construct($uid)
    {
        $this->setUid($uid);
    }

    public function getListen()
    {
        return (new $this->listen);
    }
}