<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/26
 * Time: 下午4:19
 */

namespace App\Traits;


use App\Utility\Redis;
use MongoDB\BSON\ObjectId;

trait CacheTrait
{

    /**
     * key 规则 表名:主键名:主键值
     * 缓存获取
     */
    private function stringGet($key)
    {
        $data = $this->redis->get($key);
        if (!$data) {
            $filter = $this->createFilter($key);
            $dbInfo = $this->getTableInfo($key);
            $data = $this->mongo->{$dbInfo['db']}->{$dbInfo['table']}->findOne($filter);
            $data = $this->objectToArray($data);
            $this->redis->set($key,serialize($data));
            return $data;
        }
        return unserialize($data);
    }

    /**
     * 更新string 或者设置string
     * key 规则 表名:主键名:主键值
     * @param $key
     * @param $value
     */
    private function stringSet($key,$value)
    {
        $filter = $this->createFilter($key);
        $dbInfo = $this->getTableInfo($key);
        $data = $this->mongo->{$dbInfo['db']}->{$dbInfo['table']}->findOne($filter);
        if (empty($data)) {
            //没有  插入
            if (array_key_exists('_id',$value)) {
                $value['_id'] = new ObjectId($value['_id']);
            }
            $res = $this->mongo->{$dbInfo['db']}->{$dbInfo['table']}->insertOne($value);
            if (!$res) {
                return false;
            }
        } else {
            //有 更新
            $res = $this->mongo->{$dbInfo['db']}->{$dbInfo['table']}->findOneAndUpdate($filter,$value);
            if (!$res) {
                return false;
            }
        }
        return $this->stringLoad($key);
    }

    /**
     * 加载一个string
     */
    private function stringLoad($key)
    {
        $filter = $this->createFilter($key);
        $dbInfo = $this->getTableInfo($key);
        $data = $this->mongo->{$dbInfo['db']}->{$dbInfo['table']}->findOne($filter);
        $data = $this->objectToArray($data);
        return $this->redis->set($key,serialize($data));

    }
    /**
     * key 规则 表名:主键名:主键值
     */
    private function zsetGet($key,$start,$end,$orderBy = 'asc')
    {
        
        if ($this->redis->exists($key)) {

            $data = $orderBy == 'asc' ?
                $this->redis->zRange($key,$start,$end) :
                $this->redis->zRevRange($key,$start,$end);
            return $data;
        }
        $loadRes = $this->zsetLoad($key);
        if ($loadRes == false) {
            return false;
        }
        return $this->zsetGet($key,$start,$end,$orderBy);
    }

    /**
     * 加载zset进来
     */
    private function zsetLoad($key)
    {
        $filter = $this->createFilter($key);
        $dbInfo = $this->getTableInfo($key);
        $datas = $this->mongo->{$dbInfo['db']}->{$dbInfo['table']}->findOne($filter);
        if (!empty($datas['items'])) {
            foreach ($datas['items'] as $data) {
                $this->redis->zAdd($key,$data['score'],$data['key']);
            }
        }
        return false;
    }
    /**
     * key 规则 表名:主键名:主键值
     * @param $key
     * @param $value
     * @param $score
     */
    private function zsetSet($key,$value,$score)
    {
        $this->redis = Redis::getInstance()->getConnect();
        $dbInfo = $this->getTableInfo($key);
        $filter = $this->createFilter($key);
        if ($this->redis->exists($key)) {
            //当前zset存在
            //更新mongo
            //当前key存在  更新一下 score
            $update = [
                '$set' => [
                    'items.' . $value => [
                        'key' => $value,
                        'score' => $score,
                    ]
                ]
            ];

            $res = $this->mongo->{$dbInfo['db']}->{$dbInfo['table']}->findOneAndUpdate($filter,$update);
        } else {
            //不存在
            //创建一个mongo
            $data = $filter;
            $data['items'] = [
                $value => [
                    'key' => $value,
                    'score' => $score,
                ]
            ];
            $res = $this->mongo->{$dbInfo['db']}->{$dbInfo['table']}->insertOne($data);
        }

        if ($res) {
            return $this->zsetLoad($key);
        }
        return false;
    }

    /**
     * 创建查询条件
     */
    private function createFilter($key)
    {
        $keyInfo = explode(':',$key);
        if ($keyInfo['1'] == '_id') {
            $filter = ['_id' => new ObjectId($keyInfo['2'])];
        } else {
            $filter = [$keyInfo['1'] => (int)$keyInfo['2']];
        }
        return $filter;
    }

    /**
     * 获取表名
     * @param $key
     */
    private function getTableInfo($key)
    {
        $keyInfo = explode(':',$key);
        $dbInfo = explode('.',$this->mongoTable);
        return [
            'table' => $keyInfo['0'],
            'db' => $dbInfo['0'],
        ];
    }

    /**
     *mongo对象转数组
     */
    private function objectToArray($object)
    {
        $result = json_encode($object);
        return json_decode($result,true);
    }
}