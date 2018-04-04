<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/4
 * Time: 下午4:07
 * redis事件
 */
namespace App\Eventuse;

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

        $gloableChannel = Config::getInstance()->getConf('REDIS_CHANNEL.gloable');

        $this->redis->subscribe(); //监控的频道 和回调

    }

    /**
     * 自动注册
     */
    public function autoRegister()
    {

    }
}