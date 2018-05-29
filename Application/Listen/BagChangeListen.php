<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/29
 * Time: 上午10:05
 */

namespace App\Listen;


use EasySwoole\Core\Swoole\ServerManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BagChangeListen implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            "bag.change" => [
                ['onAdd',30],
                ['onDel',30],
            ],
        ];
    }

    public function onAdd()
    {
        
    }

    public function onDel()
    {
        
    }

    private function push($fd,$str)
    {
        ServerManager::getInstance()->getServer()->push($fd,$str,WEBSOCKET_OPCODE_BINARY);
    }
}