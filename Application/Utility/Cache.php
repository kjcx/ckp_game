<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/29
 * Time: 上午10:07
 */

namespace App\Utility;


use EasySwoole\Config;
use EasySwoole\Core\AbstractInterface\Singleton;

class Cache
{
    use Singleton;

    const queueKey = 'DataList';//持久化队列key
    private $readConnect;
    private $writeConnect;


    public function __construct()
    {
        $this->readConnect = new \Redis();
        $this->writeConnect = new \Redis();
        $this->readConnect();
        $this->writeConnect();
    }

    /**
     * 获取一个redis的实例 具体可能遇到zset hash之类获取 没有实现的方法的时候 进行使用
     * 但是要注意 如果是set 或者是 update del之类的操作 必须使用本类提供的方法 不能直接使用redis 如果本类没有实现对应的方法 参考实现出来
     * @param string $handle
     * @return \Redis
     */
    public function client($handle = 'read')
    {
        if ($handle == 'read') {
            return $this->readConnect;
        }
        return $this->writeConnect;
    }
    /**
     * get 类似上面设置 下面读取的数据 请使用write句柄 否则读写分离可能从库并没有同步过来数据
     * @param $key
     * @param string $handle read write
     * @return bool|string
     */
    public function stringGet($key,$handle = 'read')
    {
        if ($handle == 'read') {
            $string = $this->readConnect->get($key);
        } else {
            $string = $this->writeConnect->get($key);
        }
        if ($string) {
            return json_decode($string,true);
        }
        return false;
    }

    /**
     * set指定的key类型 必须是 表名:主键:主键值 后面可以随意发挥 但是必须用:分割
     * @param $key
     * @param $data
     * @param null $ttl
     * @param bool $queue
     * @return bool|int
     */
    public function stringSet($key,$data,$ttl = null,$queue = true)
    {
        $value = json_encode($data);
        $setRes = $this->writeConnect->set($key,$value,$ttl);
        if ($setRes) {
            if ($ttl == null && $queue == true) {
                //需要持久化
                return $this->pushQueue($key,'string'); //推送持久化队列
            }
            return $setRes;
        }
        return false;
    }

    /**
     * 删除string类型的key
     * @param $key
     * @return int
     */
    public function stringDel($key)
    {
        return $this->del($key,'string');
    }

    /**
     * set指定的key类型 必须是 表名:主键:主键值 后面可以随意发挥 但是必须用:分割
     * @param $key
     * @param $member
     * @param $score
     * @param bool $queue
     * @return int
     */
    public function zsetZadd($key,$member,$score,$queue = true)
    {
        $this->writeConnect->zAdd($key,$score,$member);
        if ($queue) {
            return $this->pushQueue($key,'zset','set');
        }
        return true;
    }

    /**
     * zrem  实现的是zset的zrem
     * @param $key
     * @param $member
     * @param bool $queue
     * @return int
     */
    public function zsetZrem($key,$member,$queue = true)
    {
        $res = $this->writeConnect->zRem($key,$member);
        if ($res && $queue) {
            return $this->pushQueue($key,'zset','del');
        }
        return $res;
    }


    /**
     * 实现zRemRangeByRank
     * @param $key
     * @param $start
     * @param $end
     * @param bool $queue
     * @return int
     */
    public function zsetZremrangebyrank($key,$start,$end,$queue = true)
    {
        $res = $this->writeConnect->zRemRangeByRank($key,$start,$end);
        if ($res && $queue) {
            return $this->pushQueue($key,'zset','del');
        }
        return $res;
    }

    /**
     * 实现zRemRangeByScore
     * @param $key
     * @param $start
     * @param $end
     * @param bool $queue
     * @return int
     */
    public function zsetZremrangebyscore($key,$start,$end,$queue = true)
    {
        $res = $this->writeConnect->zRemRangeByScore($key,$start,$end);
        if ($res && $queue) {
            return $this->pushQueue($key,'zset','del');
        }
        return $res;
    }

    /**
     * 删除一个zset
     */
    public function zsetDel($key)
    {
        return $this->del($key,'zset');
    }

    /**
     * key的规则 指定的key类型 必须是 表名:主键:主键值 后面可以随意发挥 但是必须用:分割
     * @param $key
     * @param $index
     * @param $value
     * @param bool $queue
     * @return int
     */
    public function hashSet($key,$index,$value,$queue = true)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }
        $this->writeConnect->hSet($key,$index,$value);
        if ($queue) {
            return $this->pushQueue($key,'hash','set');
        }
        return true;
    }

    public function hashHINCRBY($key,$index,$value,$queue = true)
    {
        $this->writeConnect->HINCRBY($key,$index,$value);
        if($queue){
            return $this->pushQueue($key,'hash','set');
        }
        return true;
    }

    /**
     * 实现hash mset
     * @param $key
     * @param $arr
     * @param bool $queue
     * @return bool|int
     */
    public function hashMset($key,$arr,$queue = true)
    {
        $this->writeConnect->hMset($key,$arr);
        if($queue){
            return $this->pushQueue($key,'hash','set');
        }
        return true;
    }

    /**
     * 实现 hDel
     * @param $key
     * @param $index
     * @param bool $queue
     * @return int
     */
    public function hashHdel($key,$index,$queue = true)
    {
        $res = $this->writeConnect->hDel($key,$index);
        if ($res && $queue) {
            return $this->pushQueue($key,'hash','del');
        }
        return $res;
    }
    /**
     * 直接删除整个key  不是删除其中一个index  别用错了
     * @param $key
     */
    public function hashDel($key)
    {
        return $this->del($key,'hash');
    }

    /**
     * set add
     * @param $key
     * @param $value
     * @param bool $queue
     * @return int
     */
    public function setSadd($key,$value,$queue = true)
    {
        $this->writeConnect->sAdd($key,$value);
        if ($queue) {
            return $this->pushQueue($key,'set','set');
        }
        return true;
    }

    /**
     * set spop
     * @param $key
     * @param bool $queue
     * @return string
     */
    public function setSpop($key,$queue = true)
    {
        $res = $this->writeConnect->sPop($key);
        if ($res && $queue) {
            $this->pushQueue($key,'set','del');
            return $res;
        }
        return $res;
    }

    /**
     * set sRem
     * @param $key
     * @param $member
     * @param bool $queue
     * @return int
     */
    public function setSrem($key,$member,$queue = true)
    {
        $res = $this->writeConnect->sRem($key,$member);
        if ($res && $queue) {
            return $this->pushQueue($key,'set','del');
        }
        return $res;
    }
    /**
     * list 暂时使用不到 先不实现
     */
//    /**
//     * 实现redis Blpop
//     */
//    public function listBlpop($key,$ttl = null)
//    {
//        $res = $this->writeConnect->blPop($key);
//        if ($res) {
//            $this->pushQueue($key,'list','del');
//            return $res;
//        }
//        return false;
//    }
//
//    /**
//     * 实现redis brPop
//     */
//    public function listBrpop($key,$ttl = null)
//    {
//        $res = $this->writeConnect->brPop($key);
//        if ($res) {
//            $this->pushQueue($key,'list','del');
//            return $res;
//        }
//        return false;
//    }
    /**
     * 删除
     * @param $key
     */
    private function del($key,$type)
    {
        $ttl = $this->writeConnect->ttl($key);
        $delRes = $this->writeConnect->del($key);
        if ($ttl == -1) {
            //持久化数据
            if ($delRes) {
                return $this->pushQueue($key,$type,'del');
            }
        }
        return $delRes;
    }

    /**
     * 观察多个keys
     */
    public function watch($keys)
    {
        $this->writeConnect->watch($keys);
    }
    /**
     * 开启事务
     */
    public function begin()
    {
        $this->writeConnect->multi();
    }

    /**
     * 事务提交
     */
    public function commit()
    {
        return $this->writeConnect->exec();
    }
    /**
     * 表名|数据类型|动作|key|时间戳
     * 持久化数据  推送队列
     */
    private function pushQueue($key,$type,$action = 'set')
    {
        $unixTime = microtime(true);
        $filter = $this->decodeFilter($key);
        $task = "{$filter['table']}|{$type}|{$action}|{$key}|{$unixTime}";
        return $this->writeConnect->lPush(self::queueKey,$task);
    }

    /**
     * 解析filter
     */
    private function decodeFilter($key)
    {
        $filter = explode(':',$key);
        return [
            'table' => $filter['0'],
            'key' => $filter['1'],
            'keyValue' => $filter['2'],
        ];
    }
    private function readConnect()
    {
        $conf = Config::getInstance()->getConf("REDIS_SLAVE");
        $this->readConnect->connect($conf['host'],$conf['port']);
        if (!empty($conf['auth'])) {
            $this->readConnect->auth($conf['auth']);
        }
        $this->readConnect->select($conf['dbname']);
    }
    private function writeConnect()
    {
        $conf = Config::getInstance()->getConf("REDIS_SERVER");
        $this->writeConnect->connect($conf['host'],$conf['port']);
        if (!empty($conf['auth'])) {
            $this->writeConnect->auth($conf['auth']);
        }
        $this->writeConnect->select($conf['dbname']);
    }
}