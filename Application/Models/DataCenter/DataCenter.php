<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午6:04
 * 数据中心模型
 */
namespace App\Models\DataCenter;

use EasySwoole\Config;
use EasySwoole\Core\Swoole\Coroutine\PoolManager;
use App\Models\Model;

class DataCenter extends Model
{

    private $dataCenterKey;
    private $serverHash;

    public function __construct()
    {
        parent::__construct();
        $this->dataCenterKey = Config::getInstance()->getConf('rediskeys.data_center');
        $this->serverHash = Config::getInstance()->getConf('SERVER_CONF.server_hash'); //设置机器hash
        $this->setDataCenter(); //设置数据中心
    }

    /**
     * 设置数据中心
     */
    private function setDataCenter() : void
    {
        if ( !$this->redis->exists($this->dataCenterKey) )
        {
            $this->redis->sAdd($this->dataCenterKey,'init');
        }
    }

    /**
     * 判断用户是否在线  非心跳检测 只是判断数据中心是否含有当前用户
     * @param $uid
     * @return bool
     */
    private function checkUserIsOnline($uid) : bool
    {
        if ($this->redis->sIsMember($this->dataCenterKey,$uid)) {
            return true;
        }
        return false;
    }

    /**
     *设置用户上线  向在线集合中加入uid
     */
    private function userOnline($uid) : bool
    {
        return $this->redis->sAdd($this->dataCenterKey,$uid);
    }

    /**
     *删除用户连接信息
     * @param $uid
     * @return bool
     */
    private function delUserClientInfo($uid) : bool
    {
        return $this->redis->del($this->redis->keys('*:' . $uid . ':*'));

    }

    /**
     * 设置到数据中心 操作
     * @param $fd
     * @param $uid
     * @return bool
     */
    public function saveClient($fd,$uid) : bool
    {

        if ( !$this->checkUserIsOnline($uid) )
        {
            $this->userOnline($uid);
        }

        $this->delUserClientInfo($uid);
        if ($this->redis
            ->set($this->serverHash . ':' . $uid . ':' . $fd,
                serialize(['serverHash' => $this->serverHash,'uid' => $uid ,'fd' => $fd])))
        {
            return true;
        }
        return false;
    }

    /**
     * 获取所有 当前机器的fd信息
     */
    public function getMyFd() : array
    {
        //机器号 下面的所有连接信息
        $fds = $this->redis->keys($this->serverHash . ':*:*');

        foreach ($fds as $key => $fd) {
            $fds[$key] = unserialize($this->redis->get($fd));
        }
        return $fds;
    }

    /**
     * 获取用户uid  通过Fd
     * @param $fd
     * @return array ['server_hash','fd','uid'] or []
     */
    public function getUidByFdInfo($fd) : array
    {
        $keys = $this->redis->keys($this->serverHash . ':*:' . $fd);
        if ($keys) {
            return unserialize($this->redis->get($keys['0']));
        }
        return [];
    }

    /**
     * 获取用户uid  通过Fd
     * @param $fd
     * @return int
     */
    public function getUidByFd($fd) : int
    {
        $keys = $this->redis->keys($this->serverHash . ':*:' . $fd);
        if ($keys) {
//            return unserialize($this->redis->get($keys['0']))['uid'];
            $arr =  unserialize($this->redis->get($keys['0']));
            var_dump($arr['uid']);

            return $arr['uid'];
        }
        return [];
    }

}