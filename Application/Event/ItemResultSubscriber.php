<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/11
 * Time: 下午11:33
 */
namespace App\Event;
use App\Protobuf\Result\UpdateItemResult;
use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class ItemResultSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            "SellItem" => [
                ["UpdateItemResult",100],
                ["UpdateShenjiaResult",99],
                ["GoldChangedResult",98],
            ]
        ];
    }

    /**
     * 更新背包信息
     * @param Event $event
     */
    public function UpdateItemResult(Event $event)
    {
        $ItemResultEvent = new ItemResultEvent($event);
        $ItemResultEvent->updateItem();
    }
    /**
     * 更新身价
     * @param Event $event
     */
    public function UpdateShenjiaResult(Event $event)
    {
        $UserEvent = new \App\Event\UserEvent($event->uid);
        $UserEvent->UpdateShenjiaResultEvent();
    }

    /**
     * 金币变化
     */
    public function GoldChangedResult(Event $event)
    {
        var_dump("============金币变化=============");
        $UserEvent = new UserEvent($event->uid);
        $UserEvent->GoldChangedResultEvent();
    }
}