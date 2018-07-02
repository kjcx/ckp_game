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
     * @param int $ttl
     */
    public function stringSet($key,$data,$ttl = null)
    {
        $value = json_encode($data);
        $setRes = $this->writeConnect->set($key,$value,$ttl);
        if ($setRes) {
            if ($ttl == null) {
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
     */
    public function zsetZadd($key,$member,$score)
    {
        $res = $this->writeConnect->zAdd($key,$score,$member);
        if ($res) {
            return $this->pushQueue($key,'zset','set');
        }
        return false;
    }

    /**
     * zrem  实现的是zset的zrem
     * @param $key
     * @param $score
     * @param $member
     * @return bool|int
     */
    public function zsetZrem($key,$member)
    {
        $res = $this->writeConnect->zRem($key,$member);
        if ($res) {
            return $this->pushQueue($key,'zset','del');
        }
        return false;
    }


    /**
     * 实现zRemRangeByRank
     * @param $key
     * @param $start
     * @param $end
     * @return bool|int
     */
    public function zsetZremrangebyrank($key,$start,$end)
    {
        $res = $this->writeConnect->zRemRangeByRank($key,$start,$end);
        if ($res) {
            return $this->pushQueue($key,'zset','del');
        }
        return false;
    }

    /**
     * 实现zRemRangeByScore
     * @param $key
     * @param $start
     * @param $end
     * @return bool|int
     */
    public function zsetZremrangebyscore($key,$start,$end)
    {
        $res = $this->writeConnect->zRemRangeByScore($key,$start,$end);
        if ($res) {
            return $this->pushQueue($key,'zset','del');
        }
        return false;
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
     * @return bool|int
     */
    public function hashSet($key,$index,$value)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }
        $res = $this->writeConnect->hSet($key,$index,$value);
        if ($res) {
            return $this->pushQueue($key,'hash','set');
        }
        return false;
    }

    /**
     * 实现 hDel
     * @param $key
     * @param $index 要删除的索引
     * @return bool|int
     */
    public function hashHdel($key,$index)
    {
        $res = $this->writeConnect->hDel($key,$index);
        if ($res) {
            return $this->pushQueue($key,'hash','del');
        }
        return false;
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
     * @return bool|int
     */
    public function setSadd($key,$value)
    {
        $res = $this->writeConnect->sAdd($key,$value);
        if ($res) {
            return $this->pushQueue($key,'set','set');
        }
        return false;
    }

    /**
     * set spop
     * @param $key
     * @return bool|string
     */
    public function setSpop($key)
    {
        $res = $this->writeConnect->sPop($key);
        if ($res) {
            $this->pushQueue($key,'set','del');
            return $res;
        }
        return false;
    }

    /**
     * set sRem
     * @param $key
     * @param $member
     * @return bool|int
     */
    public function setSrem($key,$member)
    {
        $res = $this->writeConnect->sRem($key,$member);
        if ($res) {
            return $this->pushQueue($key,'set','del');
        }
        return false;
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
            $this->readConnect->auth($conf['auth']);
        }
        $this->writeConnect->select($conf['dbname']);
    }
}