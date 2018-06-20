<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/9
 * Time: 下午4:06
 */
namespace App\Process;

use App\Models\DataCenter\DataCenter;
use App\Utility\Redis;
use EasySwoole\Core\Swoole\Process\AbstractProcess;
use Swoole\Process;
use EasySwoole\Config;

class Subscribe extends AbstractProcess
{
    private $redis;

    public function run(Process $process)
    {
        $dataCenter = new DataCenter();
        $dataCenter->init();
        $this->redis = Redis::getInstance()->getConnect();
        $gloableChannel = Config::getInstance()->getConf('rediskeys.gloable');
        $this->redis->subscribe(array_column($gloableChannel,'0'),function ($redis, $chan, $msg) use ($gloableChannel) {
            $gloableChannel[$chan]['1']($msg);

        }); //监控的频道 和回调

    }

    public function onShutDown()
    {
        var_dump('机器' . Config::getInstance()->getConf('SERVER_CONF.server_hash') . 'redis订阅进程挂了!');
    }

    public function onReceive(string $str,...$args)
    {
        
    }
}