<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/11
 * Time: 下午11:35
 */
namespace App\Event;
use App\Models\BagInfo\Bag;
use App\Models\User\RoleBag;
use App\Protobuf\Result\AddItemResult;
use App\Protobuf\Result\UpdateItemResult;
use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\Event;

class ItemResultEvent extends UserEvent
{
    public $name = self::class;
    public $fd;
    public $uid;
    public $ids;//请求道具的id
    public function __construct($uid,$ids)
    {

        $this->uid = $uid;
        parent::__construct($this->uid);
        $DataCenter  = new \App\Models\DataCenter\DataCenter();
        $fd = $DataCenter->getFdByUid($this->uid);
        $this->fd = $fd;
        $this->ids = $ids;
    }

    /**
     * 更新道具通知
     */
    public function updateItem()
    {
        var_dump("==========更新道具==========");
        var_dump($this->ids);//返回id对应的数量
        $Bag = new Bag($this->uid);
        $items = $Bag->getBagByItemIds($this->ids);
        $data = UpdateItemResult::encode($items);
        $str = \App\Protobuf\Result\MsgBaseSend::encode(1022,$data);
        ServerManager::getInstance()->getServer()->push($this->fd,$str,WEBSOCKET_OPCODE_BINARY);
    }

    /**
     * 添加道具返回
     */
    public function addItem()
    {
        var_dump("==========添加道具返回背包信息==========");
        $data = AddItemResult::encode($this->uid);
        $str = \App\Protobuf\Result\MsgBaseSend::encode(1053,$data);
        ServerManager::getInstance()->getServer()->push($this->fd,$str,WEBSOCKET_OPCODE_BINARY);
    }

    /**
     * 出售道具
     */
    public function sellItem()
    {
        var_dump("==========出售道具==========");
        //
    }

}