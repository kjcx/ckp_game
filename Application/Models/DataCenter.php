<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午6:04
 * 数据中心模型
 */
namespace App\Models;

use EasySwoole\Config;
use EasySwoole\Core\Swoole\Coroutine\PoolManager;

class DataCenter extends Model
{


    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 设置到数据中心 操作
     * @param $fd
     * @param $uid
     */
    public function saveClient($fd,$uid)
    {

        $key = Config::getInstance()->getConf('rediskeys.data_center');
        if ( !$this->redis->sIsMember($key,$uid) ) {
            $this->redis->zAdd($key,$uid);
            $this
                ->redis
                ->set(Config::getInstance()->getConf('SERVER_CONF.server_hash') . ':' . $uid . ':' . $fd,
                    serialize($fd));
        } else {
            //删除 用户
            $this->redis->del('*:' . $uid);
        }

    }

    /**
     * 获取所有 当前机器的fd信息
     */
    public function getMyFd()
    {
        //机器号 下面的所有连接信息
        $fds = $this->redis->keys(Config::getInstance()->getConf('SERVER_CONF.server_hash') . ':*');

        array_walk($fds,function(&$fd,$key){
            $fds[$key] = unserialize($fd);
        });

        return $fds;
    }


}