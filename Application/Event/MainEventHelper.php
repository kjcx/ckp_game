<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午5:38
 * 注册一些主要的事件 当服务启动的时候
 * 带有helper的类 属于静态事件调用  我瞎起的名字  就是说直接调用静态方法
 * 当然还有动态调用的方法
 */

namespace App\Event;

use App\Utility\MysqlPool;
use App\Utility\RedisPool;
use EasySwoole\Config;
use EasySwoole\Core\Component\Event;
use EasySwoole\Core\Swoole\Coroutine\PoolManager;
use EasySwoole\Core\Swoole\ServerManager;
use Swoole\Coroutine\Http\Client;

class MainEventHelper
{

    /**
     * 热加载
     */
    public static function registerHotLoad()
    {

        \EasySwoole\Core\Swoole\Time\Timer::loop(2000,function () {
            ServerManager::getInstance()->getServer()->reload();
        });


    }
}