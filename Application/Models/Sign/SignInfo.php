<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/19
 * Time: 下午12:12
 */

namespace App\Models\Sign;


use App\Models\Model;
use think\Db;

class SignInfo extends Model
{
    public $table = 'ckzc.SignInfo';
    public $key  = 'Sign:uid:';
    public $Reward  = 'Reward:uid:';
    /**
     * 创建每月信息
     */
    public function create($Uid)
    {
        $data['Uid'] = $Uid;
        $num = date('t',time());
        $value = [];
        for ($i=1;$i<=$num;$i++){
            $value[$i]['IsSign'] = false;
//            $value[$i]['Day'] = $i;
        }
        $month = date('M',time());
        $data['Info'][$month] = $value;

        $rs = Db::table($this->table)->insert($data);
        if($rs){
            $rs = $this->setRedisSignInit($Uid);
            return $rs;
        }else{
            var_dump("创建失败");
        }
    }

    /**
     * 初始化用户信息
     * @param $Uid
     * @return bool
     */
    public function setRedisSignInit($Uid)
    {
        $key = $this->key . $Uid;
        $num = date('t',time());
        $ttl = date('t',time()) * 86400 + strtotime(date('Y-M-1',time()));
        $value = [];
        $month = date('M',time());
        for ($i=1;$i<=$num;$i++){
            $value['IsSign'] = false;
            $hashKey = $month . ':' . $i;
            $rs = $this->redis->hSet($this->key.$Uid,$hashKey,json_encode($value));
        }

        return $rs;
    }

    /**
     * 检查签收数据是否存在
     * @param $Uid
     * @return bool
     */
    public function checkSignKey($Uid)
    {
        $rs = $this->redis->exists($this->key . $Uid);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取每个人当前月签到情况
     * @param $Uid
     * @return array
     */
    public function getRedisSignMonthInfoByUid($Uid)
    {
        $key = $this->key . $Uid . ':' . date('Ym');
        $t = date('t',time());
        $list = [];
        $Seven = false;
        $Fourteen = false;
        $Twenty_one = false;
        $Twenty_eight = false;
        $data = [];
        for ($i=1;$i<= $t;$i++){
            $count = 0;
            $IsSign = $this->redis->getBit($key,$i);
            $bool  =false;
            if($IsSign){
                $bool = true;
                $count++;
                if($count == 7){//判断是否满足连续7天签到
                    $Seven = true;
                }elseif($count == 14){//判断是否满足连续14天签到
                    $Fourteen = true;
                }elseif($count == 21){//判断是否满足连续21天签到
                    $Twenty_one = true;
                }elseif($count == 28){//判断是否满足连续28天签到
                    $Twenty_eight = true;
                }
            }else{
                $count = 0;
            }
            $data[]  = ['Day'=>$i,'IsSign'=>$bool];
        }
//        $list['data'] = $data;
        //获取已领取奖励列表
        $Reward = $this->getRedisRewardByUid($Uid);
        if($Reward){

            if(isset($Reward['101'])){
                $IsSign_Seven = $Reward['101'];//判断7天签到奖励是否领取
            }else{
                $IsSign_Seven = false;
            }
            if(isset($Reward['102'])){
                $IsSign_Fourteen = $Reward['102'];//判断14天签到奖励是否领取
            }else{
                $IsSign_Fourteen = false;
            }
            if(isset($Reward['103'])){
                $IsSign_Twenty_one = $Reward['103'];//判断21天签到奖励是否领取
            }else{
                $IsSign_Twenty_one = false;
            }
            if(isset($Reward['104'])){
                $IsSign_Twenty_eight = $Reward['104'];//判断28天签到奖励是否领取
            }else{
                $IsSign_Twenty_eight = false;
            }

        }else{
            $IsSign_Seven = false;
            $IsSign_Fourteen = false;
            $IsSign_Twenty_one = false;
            $IsSign_Twenty_eight = false;
        }
        $data[] = ['Day'=>101,'IsSign'=>$IsSign_Seven];
        $data[] = ['Day'=>102,'IsSign'=>$IsSign_Fourteen];
        $data[] = ['Day'=>103,'IsSign'=>$IsSign_Twenty_one];
        $data[] = ['Day'=>104,'IsSign'=>$IsSign_Twenty_eight];
        return $data;
    }

    /**
     * 检查是否签到
     * @param $Uid
     * @param $Day
     * @return int
     */
    public function checkIsSign($Uid,$Day)
    {
        $key = $this->key . $Uid .':' . date('Ym');
        $rs = $this->redis->getBit($key,$Day);
        return $rs;
    }

    /**
     * 设置签到
     * @param $Uid
     * @param $Day
     * @return int
     */
    public function setIsSignByUid($Uid,$Day)
    {
        $key = $this->key . $Uid . ':' . date('Ym');
        $rs = $this->redis->setBit($key,$Day,1);
        if($rs == 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取用户当前月签到信息
     * @param $Uid
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getSignMonthInfoByUid($Uid)
    {
        $data = Db::table($this->table)->where('Uid',$Uid)->where('Date',date('Ym'))->find();
        return $data;
    }

    /**
     * 设置奖励是否领取
     * @param $Uid
     * @param $Num
     * @return bool|int
     */
    public function setRedisRewardByUid($Uid,$Num)
    {
        $key = $this->Reward . date('Ym') .':'. $Uid;
        $rs = $this->redis->hSet($key,$Num,true);
        return $rs;
    }

    /**
     * 获取用户领取奖励情况
     * @param $Uid
     * @return array
     */
    public function getRedisRewardByUid($Uid)
    {
        $key = $this->Reward . date('Ym') .':'. $Uid;
        $data = $this->redis->hGetAll($key);
        return $data;
    }
}