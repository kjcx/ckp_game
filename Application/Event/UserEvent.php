<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/11
 * Time: 下午11:12
 */
namespace App\Event;

use App\Models\User\RoleBag;
use App\Protobuf\Result\GoldChangedResult;
use App\Protobuf\Result\UpdateShenjiaResult;
use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
class UserEvent extends Event
{
    public $fd;
    public $uid;
    public function __construct($uid)
    {
        $DataCenter  = new \App\Models\DataCenter\DataCenter();
        $fd = $DataCenter->getFdByUid($uid);
        $this->uid = $uid;
        $this->fd = $fd;
    }

    /**
     * 通知身价变化
     */
    public function UpdateShenjiaResultEvent()
    {
        var_dump("======身价变化通知===========");
        //返回当前人的身价
        $shenjia = 1000;
        $data = UpdateShenjiaResult::encode($shenjia);
        $str = \App\Protobuf\Result\MsgBaseSend::encode(1075,$data);
        ServerManager::getInstance()->getServer()->push($this->fd,$str,WEBSOCKET_OPCODE_BINARY);
    }

    /**
     * 金币变化
     */
    public function GoldChangedResultEvent()
    {
        $role = new RoleBag();
        $gold = $role->getUserGoldByUid($this->uid,2);
        $data = GoldChangedResult::encode([2=>$gold]);
        $str = \App\Protobuf\Result\MsgBaseSend::encode(1065,$data);
        ServerManager::getInstance()->getServer()->push($this->fd,$str,WEBSOCKET_OPCODE_BINARY);
    }
}