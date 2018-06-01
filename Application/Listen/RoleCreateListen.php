<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/28
 * Time: 下午2:25
 */

namespace App\Listen;

use App\Event\RoleCreateEvent;
use App\Models\Manor\Land;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class RoleCreateListen implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            "role.create" => [
                ['initManorLand',30],
            ],
        ];
    }

    /**
     * 初始化庄园地块
     * @param RoleCreateEvent $event
     */
    public function initManorLand(RoleCreateEvent $event)
    {
        // 初始化庄园地块信息
        $land = new Land($event->getUid());
        $land->initLand();
    }
}