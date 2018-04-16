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
class ItemSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            "update" => "updateItem",
            "english.name" => [
                ["englishNameShow", -10],
                ["englishNameAFter", 10],
            ],
            "math.name" => ["mathNameShow", 100]
        ];
    }

    public function updateItem(Event $event)
    {
        echo "更新道具";
        echo  $event->name;
        echo  $event->fd;
        var_dump($event->items);
        $data = UpdateItemResult::encode();//更新道具
        $this->send(1022,$event->fd,$data);
    }
    public function send($MsgId=1022,$fd,$data)
    {
        $str = \App\Protobuf\Result\MsgBaseSend::encode($MsgId,$data);
        ServerManager::getInstance()->getServer()->push($fd,$str,WEBSOCKET_OPCODE_BINARY);
    }
    public function chineseNameShow(Event $event)
    {
        echo $event->name;
        echo "我是汉语书籍\n";
    }

    public function englishNameShow(Event $event)
    {
        echo "我是英文书籍\n";
    }

    public function englishNameAFter(Event $event)
    {
        echo "我是展示之后的英文书籍[来自于Event实例{$event->name}]\n";
    }

    public function mathNameShow(Event $event)
    {
        echo "我是展示的数学书籍\n";
    }
}