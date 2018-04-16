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

class ItemEvent extends Event
{
    public $name = self::class;
    public $fd;
    public $items;
    public function __construct($fd,$items)
    {
        $this->fd = $fd;
        $this->items = $items;
    }


}