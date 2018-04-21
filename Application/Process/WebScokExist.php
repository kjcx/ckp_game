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
        $start_fd = 0;
        while(true)
        {
            $conn_list = $serv->getClientList($start_fd, 10);
            if ($conn_list===false or count($conn_list) === 0)
            {
                echo "finish\n";
                break;
            }
            $start_fd = end($conn_list);
            var_dump($conn_list);
            foreach($conn_list as $fd)
            {
                $serv->send($fd, "broadcast");
            }
        }
    }

    public function onShutDown()
    {
        var_dump('机器' . Config::getInstance()->getConf('SERVER_CONF.server_hash') . 'redis订阅进程挂了!');
    }

    public function onReceive(string $str,...$args)
    {
        
    }
}