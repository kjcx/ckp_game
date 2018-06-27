<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/26
 * Time: 下午4:19
 */

namespace App\Traits;


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
        $this->zsetLoad($key);
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
    }
    /**
     * key 规则 表名:主键名:主键值
     * @param $key
     * @param $value
     * @param $score
     */
    private function zsetSet($key,$value,$score)
    {
        $dbInfo = $this->getTableInfo($key);
        $filter = $this->createFilter($key);
        if ($this->redis->sIsMember($key,$value)) {
            //当前key存在  更新一下 score

        } else {
            $update = [
                '$push' => ['items' => [
                    'key' => $value,
                    'score' => $score,
                ]]
            ];
        }

        $res = $this->mongo->{$dbInfo['db']}->{$dbInfo['table']}->findOneAndUpdate($filter,$update);

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