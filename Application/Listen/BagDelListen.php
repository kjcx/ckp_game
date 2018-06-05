<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/29
 * Time: 上午10:05
 */

namespace App\Listen;


use App\Event\BagDelEvent;
use App\Models\DataCenter\DataCenter;
use App\Protobuf\Result\MsgBaseSend;
use App\Protobuf\Result\UpdateItemResult;
use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BagDelListen implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            "bag.del" => [
                ['onPush',30],
            ],
        ];
    }

    public function onPush(BagDelEvent $event)
    {
        var_dump($event->data);
        $dataString = UpdateItemResult::encode($event->data['item']);
        $string = MsgBaseSend::encode(1022,$dataString);
        $dataCenter = new DataCenter();
        $fd = $dataCenter->getFdByUid($event->data['uid']);
        $this->push($fd,$string);
    }

    private function push($fd,$str)
    {
        ServerManager::getInstance()->getServer()->push($fd,$str,WEBSOCKET_OPCODE_BINARY);
    }
}