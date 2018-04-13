<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/11
 * Time: 下午11:33
 */
namespace App\Event;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
class BookSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            "chinese.name" => "chineseNameShow",
            "english.name" => [
                ["englishNameShow", -10],
                ["englishNameAFter", 10],
            ],
            "math.name" => ["mathNameShow", 100]
        ];
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