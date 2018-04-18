<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/11
 * Time: 下午11:35
 */
namespace App\Event;
use App\Models\User\RoleBag;
use App\Protobuf\Result\UpdateItemResult;
use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\Event;

class BagItemEvent extends Event
{
    public $name = self::class;
    public $fd;
    public $items;
    public function __construct($fd,$items)
    {
        $this->fd = $fd;
        $this->items = $items;
    }

    /**
     * 更新道具通知
     */
    public function updateItem()
    {
        var_dump("==========更新道具==========");
        $data = UpdateItemResult::encode();//更新道具
        $str = \App\Protobuf\Result\MsgBaseSend::encode(1022,$data);
        ServerManager::getInstance()->getServer()->push($this->fd,$str,WEBSOCKET_OPCODE_BINARY);
    }


}