<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/29
 * Time: 上午10:05
 */

namespace App\Listen;


use App\Event\BagAddEvent;
use App\Helpers\PushHelper;
use App\Protobuf\Result\AddItemResult;
use App\Protobuf\Result\UpdateItemResult;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BagAddListen implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            "bag.add" => [
                ['onPush',30],
            ],
        ];
    }

    public function onPush(BagAddEvent $event)
    {
        switch ($event->data['evenFunc']) {
            case 'pushBag':
                $this->pushBag($event);
                break;
            case 'pushChange':
                $this->pushChange($event);
                break;
        }
    }

    /**
     * 推送背包信息
     * 完全推送背包信息
     */
    private function pushBag($event)
    {
//        $dataString = AddItemResult::encode($event->data['uid']);
//        push(1053,$event->data['uid'],$dataString);

    }
    /**
     * 推送更新信息
     */
    private function pushChange($event)
    {
        $dataString = UpdateItemResult::encode($event->data['item']);
        push(1022,$event->data['uid'],$dataString);
    }

    private function push()
    {

    }
}