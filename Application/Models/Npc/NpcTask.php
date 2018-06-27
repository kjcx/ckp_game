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
        var_dump("是否存在");
        var_dump($bool);
        if(!$bool){
            $arr = [];//随机任务
            $arr = $this->checkExists($Uid);
            $this->setRedisTask($Uid,$arr);
        }
        $str = $this->redis->hGetAll($key);
        var_dump($key);
        var_dump($str);
        $arr = unserialize($str);
        var_dump($arr);
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
        var_dump('存在' .$key);
        var_dump($rs);
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
        $Npc_rand = $NpcInfo->getRedisNpcRand($Uid);
        var_dump($Npc_rand);
        $Entrust = new Entrust();
        $Role = new Role();
        $Level = $Role->getLevel($Uid);
        $Info = $Entrust->getInfoByLevel($Level);
        $TaskId = $Info['Id'];
        $str_num = '0,1,2,3,4,5,6,7,8,9';
        $new_str= str_shuffle($str_num);
        $nums[$new_str[0]] = $new_str[0];
        $nums[$new_str[1]] = $new_str[1];
        $nums[$new_str[2]] = $new_str[2];
        $nums[$new_str[3]] = $new_str[3];

        $ItemList = [];
        $NpcTask = [];
        for ($i=0;$i<10;$i++){
            $ItemList[] = $Entrust->getItemByOrderForm($Info['OrderForm']);//10次任务
            if(in_array($i,$nums)){
                $NpcTask[] = ['NpcId'=>$nums[$i],'TaskId'=>$TaskId];
            }else{
                $NpcTask[] = ['NpcId'=>'','TaskId'=>0];
            }
        }

        $Count = 10;//每个回合次数
        $RefCount = 0;//刷新次数
        return ['Count'=>$Count,'RefCount'=>$RefCount,'NpcTask'=>$NpcTask,'ItemList'=>$ItemList];

    }

}