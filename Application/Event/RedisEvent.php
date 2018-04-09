<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/4
 * Time: 下午4:07
 * redis事件
 */
namespace App\Event;

use App\Utility\Redis;
use EasySwoole\Config;

class RedisEvent
{

    public $redis;

    public function __construct()
    {
        $this->redis = Redis::getInstance()->getConnect();
    }
    /**
     *注册全局监听频道
     */
    public function registerListenChannel()
    {

        $gloableChannel = Config::getInstance()->getConf('rediskeys.gloable');
        $this->redis->subscribe(array_column($gloableChannel,'0'),function ($redis, $chan, $msg) use ($gloableChannel) {
//            $gloableChannel[$chan]['1']($msg);
            var_dump($gloableChannel);
            var_dump($msg);
        }); //监控的频道 和回调

    }

    /**
     * 自动注册
     */
    public function autoRegister()
    {
        $this->registerListenChannel();
    }

}