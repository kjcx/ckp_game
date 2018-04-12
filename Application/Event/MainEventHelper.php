<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午5:38
 * 注册一些主要的事件 当服务启动的时候
 */

namespace App\Event;

use App\Utility\MysqlPool;
use App\Utility\RedisPool;
use EasySwoole\Config;
use EasySwoole\Core\Component\Event;
use EasySwoole\Core\Swoole\Coroutine\PoolManager;
use EasySwoole\Core\Swoole\ServerManager;

class MainEventHelper
{
    /**
     *当websocket建立连接时候的事件
     */
    public static function onWebsocketConnection(Event $event)
    {

    }

    /**
     * 注册mysql服务
     */
    public static function registerMysqlPool()
    {
        $max = Config::getInstance()->getConf('MYSQL_SERVER.pool.max');
        $min = Config::getInstance()->getConf('MYSQL_SERVER.pool.min');
        PoolManager::getInstance()->addPool(MysqlPool::class, $min, $max);
    }

    public static function registerRedisPool()
    {
        $max = Config::getInstance()->getConf('REDIS_SERVER.pool.max');
        $min = Config::getInstance()->getConf('REDIS_SERVER.pool.min');
        PoolManager::getInstance()->addPool(RedisPool::class, $min, $max);
    }

    /**
     * 热加载
     */
    public static function registerHotLoad()
    {

        \EasySwoole\Core\Swoole\Time\Timer::loop(3000,function () {
            ServerManager::getInstance()->getServer()->reload();
        });


    }
}