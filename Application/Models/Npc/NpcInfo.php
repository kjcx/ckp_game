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

    public function setRedisNpcInit($Uid)
    {
        $key = $this->key . $Uid;
        $Npc = new Npc();
        $data = $Npc->getNpcInit();
        $rs = $this->redis->hMset($key,$data);
        if($rs){
           return true;
        }else{
            return false;
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
        $rs = $this->redis->hSet($key,$NpcId,true);
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
        $rs = $this->redis->hGet($key,$NpcId);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    public function getRedisNpcRand($Uid,$num)
    {
        $data = $this->getRedisNpcList($Uid);

    }

    /**
     * 已经获取的npc
     * @param $Uid
     */
    public function getRedisHaveNpc($Uid)
    {
        $data = $this->getRedisNpcList($Uid);
        $NpcIds = [];
        foreach ($data as $k=>$datum) {
            if($datum){
                $NpcIds[] = $k;
            }
        }
        return $NpcIds;
    }
}