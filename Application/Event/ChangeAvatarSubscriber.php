<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/11
 * Time: 下午11:33
 */
namespace App\Event;
use App\Protobuf\Result\AddItemResult;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Event\UserEvent;
class ChangeAvatarSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            "changeAvatar" => [
                    ["UpdateItemResult",101],
                    ["ChangeAvatar",100],
                    ["UpdateShenjiaResult",99],
                    ["UpdateAvatar",98],
                    ["UpdateShenjiaResult",97],

                ],
        ];
    }

    /**
     * 改变属性事件
     * @param Event $event
     * @param \App\Event\UserEvent $UserEvent
     */
    public function ChangeAvatar(Event $event)
    {
        var_dump("======改变属性事件=========");
        $event->ChangeAvatarResult();
    }

    /**
     * 更新属性事件
     * @param Event $event
     */
    public function UpdateAvatar(Event $event)
    {
        var_dump("======更新属性事件=========");
        $event->UpdateAvatarResult($event->uid);
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
     * 返回背包信息
     * @param Event $event
     */
    public function AddItemResult(Event $event)
    {
        $ItemResultEvent = new ItemResultEvent($event);
        $ItemResultEvent->addItem();
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

}