<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/11
 * Time: 下午11:35
 */
namespace App\Event;
use App\Models\User\RoleBag;
use App\Protobuf\Result\AddItemResult;
use App\Protobuf\Result\UpdateItemResult;
use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\Event;

class SellItemEvent extends Event
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