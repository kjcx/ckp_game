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
class ChangeItemSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            "SellItem" => [//出售道具
                ["UpdateItemResult",100],
                ["UpdateShenjiaResult",99],
                ["GoldChangedResult",98],
            ],
            "BuyItem"=>[//后买道具
                ["AddItem",100],
                ["UpdateShenjiaResult",99],
                ["GoldChangedResult",98],
            ]
        ];
    }

    /**
     * 更新背包道具信息
     * @param ChangeItemEvent $event
     */
    public function UpdateItemResult(ChangeItemEvent $event)
    {
        $ItemResultEvent = new ItemResultEvent($event->uid,$event->ids);
        $ItemResultEvent->updateItem();
    }
    /**
     * 更新身价
     * @param ChangeItemEvent $event
     */
    public function UpdateShenjiaResult(ChangeItemEvent $event)
    {
        $UserEvent = new UserEvent($event->uid);
        $UserEvent->UpdateShenjiaResultEvent();
    }

    /**
     * 金币变化
     * @param ChangeItemEvent $event
     */
    public function GoldChangedResult(ChangeItemEvent $event)
    {
        var_dump("============金币变化=============");
        $UserEvent = new UserEvent($event->uid);
        $UserEvent->GoldChangedResultEvent();
    }

    /**
     * 购买道具
     * @param ChangeItemEvent $event
     */
    public function AddItem(ChangeItemEvent $event)
    {
        var_dump("=========购买道具=======");
        $Item  = new ItemResultEvent($event->uid);
        $Item->addItem();
    }
}