<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/26
 * Time: 下午4:22
 */

namespace App\Models\Npc;


use App\Models\Excel\Npc;
use App\Models\Model;

class NpcInfo extends Model
{
    public $table = 'Npc';
    public $key = 'NpcList:';
    public $num = 4;//委托任务随机取4个
    public function setRedisNpcInit($Uid)
    {
        $key = $this->key . $Uid;
        $Npc = new Npc();
        $data = $Npc->getNpcInit();
        foreach ($data as $datum) {
            $this->redis->hSet($key,$datum['NpcId'],serialize($datum));
        }
    }

    /**
     * 设置解锁npcid
     * @param $Uid
     * @param $NpcId
     * @return bool
     */
    public function setRedisNpcUnlock($Uid,$NpcId)
    {
        $key = $this->key . $Uid;
        $exists = $this->redis->exists($key);
        if(!$exists){
            $this->setRedisNpcInit($Uid);
        }

        $str = $this->redis->hGet($key,$NpcId);
        $arr = unserialize($str);
        $arr['Status'] = true;

        $rs = $this->redis->hSet($key,$NpcId,serialize($arr));
        if($rs){
           return true;
        }else{
            return false;
        }
    }

    /**
     * 获取npc列表
     * @param $Uid
     * @return bool|int
     */
    public function getRedisNpcList($Uid)
    {
        $key  = $this->key .$Uid;
        $exists = $this->redis->exists($key);
        if(!$exists){
            $rs = $this->setRedisNpcInit($Uid);
        }
        $list = $this->redis->hGetAll($key);
        foreach ($list as &$item) {
            $item = unserialize($item);
        }
        return $list;
    }

    /**
     * 验证当前npc状态
     * @param $Uid
     * @param $NpcId
     * @return bool
     */
    public function checkNpcStatus($Uid,$NpcId)
    {
        $key = $this->key . $Uid;

        $str = $this->redis->hGet($key,$NpcId);
        $arr = unserialize($str);
        if($arr['Status']){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 随机取4个居民
     * @param $Uid
     * @param $num
     * @return mixed
     */
    public function getRedisNpcRand($Uid)
    {
        $data = $this->getRedisHaveNpc($Uid);
        mt_srand();
        $keys = array_rand($data,$this->num);
        $arr = [];
        foreach ($keys as $item) {
            $arr[] = $data[$item];
        }
        return $arr;
    }

    /**
     * 已经解锁的npc
     * @param $Uid
     * @return array
     */
    public function getRedisHaveNpc($Uid)
    {
        $data = $this->getRedisNpcList($Uid);
        $NpcIds = [];
        foreach ($data as $k=>$datum) {
            if($datum['Status']){
                $NpcIds[] = $k;
            }
        }
        return $NpcIds;
    }

    /**
     * 通过用户id和npcid获取记录信息
     * @param $Uid
     * @param $NpcId
     * @return array|mixed
     */
    public function getRedisInfoByUidNpcId($Uid,$NpcId)
    {
        $key = $this->key .$Uid;
        $str = $this->redis->hGet($key,$NpcId);
        $arr = unserialize($str);
        if($arr){
            return $arr;
        }else{
            return [];
        }
    }

    /**
     * 设置居民好感度
     * @param $Uid
     * @param $NpcId
     * @param $FavourValue
     * @return bool
     */
    public function setRedisCurrentFavorability($Uid,$NpcId,$FavourValue)
    {
        $key = $this->key . $Uid;
        $arr = $this->getRedisInfoByUidNpcId($Uid,$NpcId);
        $arr['CurrentFavorability'] = $arr['CurrentFavorability'] + $FavourValue;
        $rs = $this->redis->hSet($key,unserialize($arr));
        if($rs){
            return true;
        }else{
            return false;
        }
    }
}