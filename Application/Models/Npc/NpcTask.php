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
    public function getRedisTask($Uid)
    {
        $key = $this->key . $Uid;
        $bool = $this->checkExists($Uid);
        if(!$bool){
            $arr = $this->CreateTask($Uid);//创建任务
            $this->setRedisTask($Uid,$arr);//设置过期时间
        }
        $str = $this->redis->hGetAll($key);
<<<<<<< HEAD
        $arr = unserialize($str);
=======

        $arr = unserialize($str);

>>>>>>> 9f3de57b52f9d14e2f38d831f4d66ac2156c15e3
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

        $Entrust = new Entrust();
        $Role = new Role();
        $Level = $Role->getLevel($Uid);
        $Info = $Entrust->getInfoByLevel($Level);
        $TaskId = $Info['Id'];
        $str_num = '0,1,2,3,4,5,6,7,8,9';
        $new_str= str_shuffle($str_num);
        $ItemList = [];
        $ItemList1 = $Entrust->getItemByOrderForm($Info['OrderForm']);
        $ItemList2 = $Entrust->getItemByOrderForm($Info['OrderForm']);
        $ItemList3 = $Entrust->getItemByOrderForm($Info['OrderForm']);
        $ItemList4 = $Entrust->getItemByOrderForm($Info['OrderForm']);
        $NpcTask = [];
        //初始化4个点
        $NpcTask[$new_str[0]] = ['NpcId'=>$Npc_Rand[0],'TaskId'=>$TaskId,'ItemList'=>$ItemList1,'Spot'=>$new_str[0]];
        $NpcTask[$new_str[1]] = ['NpcId'=>$Npc_Rand[1],'TaskId'=>$TaskId,'ItemList'=>$ItemList2,'Spot'=>$new_str[1]];
        $NpcTask[$new_str[2]] = ['NpcId'=>$Npc_Rand[2],'TaskId'=>$TaskId,'ItemList'=>$ItemList3,'Spot'=>$new_str[2]];
        $NpcTask[$new_str[3]] = ['NpcId'=>$Npc_Rand[3],'TaskId'=>$TaskId,'ItemList'=>$ItemList4,'Spot'=>$new_str[3]];

        $Count = 10;//每个回合次数
        $RefCount = 0;//刷新次数

        return ['Count'=>$Count,'RefCount'=>$RefCount,'NpcTask'=>$NpcTask];
    }

}