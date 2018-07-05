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
use App\Utility\Cache;

class NpcInfo extends Model
{
    public $table = 'Npc';
    public $key = 'NpcList:uid';
    public $num = 4;//委托任务随机取4个
    public $cache;
    public function __construct()
    {
        parent::__construct();
        $this->cache = Cache::getInstance();
    }

    public function setRedisNpcInit($Uid)
    {
        $key = $this->key . $Uid;
        $Npc = new Npc();
        $data = $Npc->getNpcInit();
        foreach ($data as $datum) {
            $this->cache->hashSet($key,$datum['NpcId'],serialize($datum));
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
        $exists = $this->cache->client()->exists($key);
        if(!$exists){
            $this->setRedisNpcInit($Uid);
        }

        $str = $this->cache->client()->hGet($key,$NpcId);
        $arr = unserialize($str);
        $arr['Status'] = true;

        $rs = $this->cache->hashSet($key,$NpcId,serialize($arr));
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
        $exists = $this->cache->client()->exists($key);
        if(!$exists){
            $rs = $this->setRedisNpcInit($Uid);
        }
        $list = $this->cache->client()->hGetAll($key);
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

        $str = $this->cache->client()->hGet($key,$NpcId);
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
        $str = $this->cache->client()->hGet($key,$NpcId);
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
        $rs = $this->cache->hashSet($key,$arr['NpcId'],serialize($arr));
        var_dump($rs);
        if($rs>=0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 更新npc品质加1级
     * @param $Uid
     * @param $NpcId
     * @return bool
     */
    public function setRedisUpdateFavorabilityLevel($Uid,$NpcId)
    {
        $key = $this->key . $Uid;
        $arr = $this->getRedisInfoByUidNpcId($Uid,$NpcId);
        $arr['FavorabilityLevel'] = $arr['FavorabilityLevel'] + 1;
        $rs = $this->cache->hashSet($key,$arr['NpcId'],serialize($arr));
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取已经任职npcid
     * @param $Uid
     * @return array
     */
    public function getRedisNpcAppointed($Uid)
    {
        $arr = $this->getRedisNpcList($Uid);
        $DownId = [];
        foreach ($arr as $item) {
            if($item['Appointed']){
                $DownId[] = $item['NpcId'];
            }
        }
        return $DownId;
    }

    /**
     * 取消npc任职
     * @param $Uid
     * @param $DownId
     * @return bool
     */
    public function CancelAppointedAll($Uid,$DownId)
    {
        if($DownId){
            $key = $this->key . $Uid;
            foreach ($DownId as $item) {
                $str = $this->cache->client()->hGet($key,$item);
                $arr = unserialize($str);
                $arr['Appointed'] = false;
                $this->cache->hashSet($key,$item,serialize($arr));
            }
        }
        return true;
    }

    /**
     * 设置居民任职
     * @param $Uid
     * @param $Ids
     * @return bool
     */
    public function setRedisNpcAppointed($Uid,$Ids)
    {
        if($Ids){
            $key = $this->key . $Uid;
            foreach ($Ids as $id) {
                $str = $this->cache->client()->hGet($key,$id);
                $arr = unserialize($str);
                $arr['Appointed'] = true;
                $this->cache->hashSet($key,$id,serialize($arr));
            }
        }
        return true;
    }
}