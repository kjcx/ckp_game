<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/11
 * Time: 下午11:35
 */
namespace App\Event;
use App\Protobuf\Result\ChangeAvatarResult;
use App\Protobuf\Result\UpdateAvatarResult;
use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\Event;

class ChangeAvatarEvent extends Event
{
    public $name = self::class;
    public $fd;
    public $ids;
    public $uid;
    public function __construct($uid,$ids)
    {
        $DataCenter  = new \App\Models\DataCenter\DataCenter();
        $fd = $DataCenter->getFdByUid($uid);
        $this->uid = $uid;
        $this->fd = $fd;
        $this->ids = $ids;
    }

    /**
     * 改变属性
     */
    public function ChangeAvatarResult()
    {
        $data = ChangeAvatarResult::encode($this->uid);//改变装扮属性
        $str = \App\Protobuf\Result\MsgBaseSend::encode(1055,$data);
        ServerManager::getInstance()->getServer()->push($this->fd,$str,WEBSOCKET_OPCODE_BINARY);
       
    }

    /**
     * 更新属性
     */
    public function UpdateAvatarResult()
    {
        $data = UpdateAvatarResult::encode($this->ids);//更新装扮属性
        $str = \App\Protobuf\Result\MsgBaseSend::encode(1074,$data);
        ServerManager::getInstance()->getServer()->push($this->fd,$str,WEBSOCKET_OPCODE_BINARY);
    }

}