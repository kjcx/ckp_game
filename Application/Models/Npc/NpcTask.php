<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/26
 * Time: 下午9:12
 */

namespace App\Models\Npc;


use App\Models\Excel\Entrust;
use App\Models\Model;
use App\Models\User\Role;

class NpcTask extends Model
{

    public $expiry_time = 8 * 3600;
    public $key = 'NpcTask:';
    public $num = [0,1,2,3,4,5,6,7,8,9];
    public function getRedisTask($Uid)
    {
        $key = $this->key . $Uid;
        $bool = $this->checkExists($Uid);
        if(!$bool){
            $arr = $this->CreateTask($Uid);//创建任务
            $this->setRedisTask($Uid,$arr);//设置过期时间
        }

        $str = $this->redis->get($key);
        $arr = unserialize($str);
        $ttl = $this->redis->ttl($key);
        $arr['NextTime'] = $ttl;
        return $arr;
    }

    /**
     * 设置任务 每8个小时过期
     * @param $Uid
     * @param $arr
     */
    public function setRedisTask($Uid,$arr)
    {
        $key = $this->key . $Uid;
        $this->redis->setex($key,$this->expiry_time,serialize($arr));
    }

    /**
     * 更新redis任务
     * @param $Uid
     * @param $arr
     * @return bool
     */
    public function setRedisUpdateTask($Uid,$arr)
    {
        $key = $this->key . $Uid;
        $ttl = $this->redis->ttl($key);

        $expiry_time = $this->expiry_time - $ttl;
        $rs = $this->redis->setex($key,$expiry_time,serialize($arr));
        if($rs){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 验证是否存在key
     * @param $Uid
     * @return bool
     */
    public function checkExists($Uid)
    {
        $key = $this->key . $Uid;
        $rs = $this->redis->exists($key);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 创建委托任务
     * @param $Uid
     * @return array
     */
    public function CreateTask($Uid)
    {
        $NpcInfo = new NpcInfo();
        //随机4个
        $Npc_Rand = $NpcInfo->getRedisNpcRand($Uid);
        $data_info1 = $this->getTaskInfoByUid($Uid);
        $data_info2 = $this->getTaskInfoByUid($Uid);
        $data_info3 = $this->getTaskInfoByUid($Uid);
        $data_info4 = $this->getTaskInfoByUid($Uid);
        $TaskId = $data_info1['TaskId'];
        $ItemList1 = $data_info1['ItemList'];
        $ItemList2 = $data_info1['ItemList'];
        $ItemList3 = $data_info1['ItemList'];
        $ItemList4 = $data_info1['ItemList'];
        mt_srand();
        shuffle($this->num);
        $NpcTask = [];
        //初始化4个点
        $NpcTask[$this->num[0]] = ['NpcId'=>$Npc_Rand[0],'TaskId'=>$TaskId,'ItemList'=>$ItemList1,'Spot'=>$this->num[0]];
        $NpcTask[$this->num[1]] = ['NpcId'=>$Npc_Rand[1],'TaskId'=>$TaskId,'ItemList'=>$ItemList2,'Spot'=>$this->num[1]];
        $NpcTask[$this->num[2]] = ['NpcId'=>$Npc_Rand[2],'TaskId'=>$TaskId,'ItemList'=>$ItemList3,'Spot'=>$this->num[2]];
        $NpcTask[$this->num[3]] = ['NpcId'=>$Npc_Rand[3],'TaskId'=>$TaskId,'ItemList'=>$ItemList4,'Spot'=>$this->num[3]];

        $Count = 10;//每个回合次数
        $RefCount = 0;//刷新次数

        return ['Count'=>$Count,'RefCount'=>$RefCount,'NpcTask'=>$NpcTask];
    }

    /**
     * 更新任务
     * @param $Uid
     * @param $Spot
     * @return bool
     */
    public function UpdateTask($Uid,$Spot)
    {
        //获取新的npcid
        $NewNpcId = $this->getNewNpcId($Uid);
        //删除完成任务的npcid
        $data = $this->getRedisTask($Uid);

        $item = $this->num;
        $OldTaskId = '';
        foreach ($data['NpcTask'] as $k =>$datum) {
            if(in_array($k,$item)){
                unset($item[$k]);
                $OldTaskId = $datum['TaskId'];
            }
        }

        mt_srand();
        shuffle($item);
        $NewSpot = $item[0];

        $data['Count'] = $data['Count'] - 1;
        unset($data['NpcTask'][$Spot]);
        $TaskInfo = $this->getTaskInfoByUid($Uid);
        $ItemList = $TaskInfo['ItemList'];
        $data['NpcTask'][$NewSpot] = ['NpcId'=>$NewNpcId,'Spot'=>$NewSpot,'TaskId'=>$OldTaskId,'ItemList'=>$ItemList];
        $rs = $this->setRedisUpdateTask($Uid,$data);
        if($rs){
            return ['NpcId'=>$NewNpcId,'Spot'=>$NewSpot,'TaskId'=>$OldTaskId,'ItemList'=>$ItemList];;
        }else{
            return false;
        }

        
    }

    /**
     * 随机一个新的npc居民
     * @param $Uid
     * @return mixed
     */
    public function getNewNpcId($Uid)
    {
        $arr  = $this->getRedisTask($Uid);
        $NpcTask = $arr['NpcTask'];
        $data_npc = [];
        $NpcIds = [];
        foreach ($NpcTask as $Spot => $item) {
            $NpcIds[] = $item['NpcId'];
        }
        $NpcInfo = new NpcInfo();
        $data_npc = $NpcInfo->getRedisHaveNpc($Uid);
        //取差集
        $diff = array_diff($data_npc,$NpcIds);
        mt_srand();
        return $diff[array_rand($diff)];
    }

    /**
     * 用过uid获取任务id
     * @param $Uid
     * @return array
     */
    public function getTaskInfoByUid($Uid)
    {
        $Entrust = new Entrust();
        $Role = new Role();
        $Level = $Role->getLevel($Uid);
        $Info = $Entrust->getInfoByLevel($Level['level']);
        $TaskId = $Info['Id'];
        $ItemList = $Entrust->getItemByOrderForm($Info['OrderForm']);
        return ['TaskId'=>$TaskId,'ItemList'=>$ItemList];
    }
}