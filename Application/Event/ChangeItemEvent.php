<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/17
 * Time: 下午11:22
 */

namespace App\Event;


use Symfony\Component\EventDispatcher\Event;

class ChangeItemEvent extends Event
{
    public $name = self::class;
    public $fd;
    public $uid;
    public $ids;
    public function __construct($uid,$ids)
    {
        $this->uid = $uid;
        $DataCenter  = new \App\Models\DataCenter\DataCenter();
        $fd = $DataCenter->getFdByUid($this->uid);
        $this->fd = $fd;
        $this->ids = $ids;
    }
}
