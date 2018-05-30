<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/29
 * Time: 上午10:04
 */

namespace App\Event;

use App\Listen\BagAddListen;
use App\Traits\UserTrait;
use Symfony\Component\EventDispatcher\Event;

class BagAddEvent extends Event
{
    use UserTrait;
    protected $listen = BagAddListen::class;
    public $data;
    const NAME = 'bag.add';

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