<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/4/3
 * Time: 下午6:04
 * 数据中心模型
 */
namespace App\Models\DataCenter;

use App\Utility\Cache;
use EasySwoole\Config;
use EasySwoole\Core\Swoole\Coroutine\PoolManager;
use App\Models\Model;

class DataCenter extends Model
{

    private $dataCenterKey;
    private $serverHash;
    private $cache;
    private $dataCenterServer;

    public function __construct()
    {
        parent::__construct();
        $this->dataCenterKey = Config::getInstance()->getConf('rediskeys.data_center');
        $this->serverHash = Config::getInstance()->getConf('SERVER_CONF.server_hash'); //设置机器hash
        $this->cache = Cache::getInstance();
        $this->dataCenterServer = 'dataCenterHash:serverHash:' . $this->serverHash;//当前机器的hash列表
    }

    /**
     * 初始化数据中心问题
     */
    public function init()
    {
        if ($this->cache->client('write')->exists($this->dataCenterServer)) {
            $this->cache->hashDel($this->dataCenterServer);
        }
    }

    /**
     * 判断用户是否在线  非心跳检测 只是判断数据中心是否含有当前用户
     * @param $uid
     * @return bool
     */
    private function checkUserIsOnline($uid) : bool
    {
        if ($this->cache->client('write')->hGet($this->dataCenterKey,$uid)) {
            return true;
        }
        return false;
    }

    /**
     *设置用户上线  向在线集合中加入uid
     */
    private function userOnline($uid,$fd)
    {
        $value = ['serverHash' => $this->serverHash,'uid' => $uid,'fd' => $fd];
        //设置到总的数据中心 以uid为hash的index
        if ($this->cache->hashSet($this->dataCenterKey,$uid,$value)) {
            //设置到当前机器的用户中心
            if ($this->cache->hashSet($this->dataCenterServer,$fd,$value)) {
                //以 FD作为index
                return true;
            }
        }
        return false;
    }

    /**
     * 用户下线
     */
    private function userOffline($uid,$fd)
    {
        //删总的hash
        $this->cache->hashHdel($this->dataCenterKey,$uid);
        //删当前机器的hash
        return $this->cache->hashHdel($this->dataCenterServer,$fd);
    }

    /**
     * 设置到数据中心 操作
     * @param $fd
     * @param $uid
     * @return bool
     */
    public function saveClient($fd,$uid) : bool
    {
        return $this->userOnline($uid,$fd);

    }

    /**
     * 用户下线操作 与saveClient相对
     * @param $fd
     * @return bool
     */
    public function delClient($fd)
    {
        $clientInfo = $this->getClientInfoByFd($fd);
        if (!empty($clientInfo)) {
            $this->userOffline($clientInfo['uid'],$fd);
            return true;
        }
        return false;
    }

    /**
     * 获取用户uid  通过Fd
     * @param $fd
     * @return array ['serverHash','fd','uid'] or []
     */
    public function getClientInfoByFd($fd) : array
    {
        $clientInfo = $this->cache->client('write')->hGet($this->dataCenterServer,$fd);
        if (!empty($clientInfo)) {
            return json_decode($clientInfo,true);
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
        $clientInfo = $this->getClientInfoByFd($fd);
        if ($clientInfo) {
            return $clientInfo['uid'];
        }
        return '';
    }

    /**
     * 通过uid获取fd
     * @param $uid
     * @return array
     */
    public function getFdByUid($uid)
    {

        $clientInfo = $this->cache->client('write')->hGet($this->dataCenterKey,$uid);
        $clientInfo = json_decode($clientInfo,true);
        if (!empty($clientInfo)) {
            return $clientInfo['fd'];
        }
        return '';
    }
}