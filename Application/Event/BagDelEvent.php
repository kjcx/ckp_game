<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/29
 * Time: 上午10:04
 */

namespace App\Event;

use App\Listen\BagDelListen;
use App\Traits\UserTrait;
use Symfony\Component\EventDispatcher\Event;

class BagDelEvent extends Event
{
    use UserTrait;
    protected $listen = BagDelListen::class;
    public $data;
    const NAME = 'bag.del';

    /**
     * BagAddEvent constructor.
     * @param $data [uid item]
     */
    public function __construct($data)
    {
        $this->setUid($data['uid']);
        $this->data = $data;
    }

    public function getListen()
    {
        return (new $this->listen);
    }
}