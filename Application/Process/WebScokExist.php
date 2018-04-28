<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/9
 * Time: 下午4:06
 */
namespace App\Process;

use App\Utility\Redis;
use EasySwoole\Core\Swoole\Process\AbstractProcess;
use Swoole\Coroutine\Http\Client;
use Swoole\Process;
use EasySwoole\Config;

class WebScokExist extends AbstractProcess
{
    private $redis;

    public function run(Process $process)
    {
        $this->redis = Redis::getInstance()->getConnect();
        $gloableChannel = Config::getInstance()->getConf('rediskeys.gloable');
        //遍历所有连接fd
        $this->addTick(3000,function (){
            $url = 'http://192.168.31.232:9501/index/index';
            $cli = new Client('192.168.31.232','9501');
            $cli->setHeaders([
                'Host' => "localhost",
                "User-Agent" => 'Chrome/49.0.2587.3',
                'Accept' => 'text/html,application/xhtml+xml,application/xml',
                'Accept-Encoding' => 'gzip',
            ]);
            $cli->set([ 'timeout' => 1]);
            $cli->get('/index/index');
            echo $cli->body;
            $cli->close();
        });


    }

    public function onShutDown()
    {
        var_dump('机器' . Config::getInstance()->getConf('SERVER_CONF.server_hash') . 'redis订阅进程挂了!');
    }

    public function onReceive(string $str,...$args)
    {
        
    }
}