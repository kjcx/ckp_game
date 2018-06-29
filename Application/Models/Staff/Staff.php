<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 下午2:32
 */

namespace App\Models\Staff;


use App\Models\Company\Shop;
use App\Models\Model;
use App\Models\Store\DropStaff;
use think\Db;

/**
 * 员工
 * Class Staff
 * @package App\Models\Staff
 */
class Staff extends Model
{
    public $table = 'ckzc.Staff';
    public $key = 'TodayTrainNum:';
    public $TalkGroupName = 'TalkGroup';
    /**
     * 创建员工
     * @param $Uid 用户id
     * @param $Type 员工类型
     * @param $IsFree 是否免费
     * @return bool|mixed
     */
    public function createStaff($Uid,$Type,$IsFree)
    {
        //1 通过招聘抽了类型 和是否免费抽取 获取对应的 掉落库
        $DropStaff = new DropStaff();
        if($IsFree){
            $data = $DropStaff->getLottoFreeDropLib($Type);
        }else{
            $data = $DropStaff->getLottoDropLib($Type);
        }
        $number = $DropStaff->getNumber($Type);
        $StaffInfos = [];
        for ($i=0; $i<$number;$i++){
            //2 随机掉落库 id
            $arr = $DropStaff->mt_rand($data);
            //2 获取掉落库信息
            $Info = $DropStaff->getDropLibInfo($arr);
            //3 随机获取 员工id
            $arr = $DropStaff->getRadnDropLib($Info);
            //4. 获取员工信息
            $StaffInfo = $DropStaff->getStaffInfo($arr);
            //5 插入数据库
//        $DropStaff = new DropStaff();
//        $data = $DropStaff->rand($Type,true);
            $StaffInfo['Uid'] = $Uid;
            $StaffInfo['CreateTime'] = time();
            $StaffInfo['ShopId'] = "";
            $StaffInfo['Pos'] = 0;
            $StaffInfo['LevelUpTime'] = 0;
            $StaffInfo['Appointed'] = false;
            $StaffInfo['TrainNum'] = 0;//总培训次数
            $StaffInfo['TodayTrainNum'] = 0;//今日培训次数
            var_dump($StaffInfo);
            $rs = Db::table($this->table)->insert($StaffInfo);
            if($rs){
                $StaffInfo['_id'] = Db::getLastInsID();
                $StaffInfos[] = $StaffInfo;
            }else{
                return false;
            }
        }
        return $StaffInfos;

    }

    /**
     * 通过uid获取所有员工
     * @param $Uid
     * @return array|bool|false|\PDOStatement|string|\think\Collection
     */
    public function getAllByUid($Uid)
    {
        $data = Db::table($this->table)->where(['Uid'=>$Uid])->select();
        if($data){
            return $data;
        }else{
            return false;
        }
    }

    /**
     * 调入员工
     * @param $Uid 用户id
     * @param $data
     * @return bool
     */
    public function setStaffShop($Uid,$data)
    {
        $NpcCardIds = $data['NpcCardId'];
        $ShopId = $data['ShopId'];
        if($data['ComeOutInEmployee'] == 1){
            //调出
            $rs =  Db::table($this->table)->where('Uid',$Uid)->where('_id','in',$NpcCardIds)->update(['ShopId'=>"",'Appointed'=>false]);
        }else{
            //调入
            $count = $this->getShopStaffCountByShopId($ShopId);//当前数量
            $new_count = count($NpcCardIds);//新调入数量
            $Shop = new Shop();
            $data_Shop = $Shop->getInfoById($ShopId);//店铺信息
            if($data_Shop['EmployeeLimit'] >= ($count + $new_count)){
                $rs =  Db::table($this->table)->where('Uid',$Uid)->where('_id','in',$NpcCardIds)->update(['ShopId'=>$ShopId,'Appointed'=>true]);
            }else{
//                var_dump("员工数量超出");
                return false;
            }

        }
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取店铺员工数量
     * @param $ShopId
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getShopStaffCountByShopId($ShopId)
    {
        $count = Db::table($this->table)->where(['ShopId'=>$ShopId])->select();
        return count($count);
    }

    /**
     * 获取店铺下所有员工
     * @param $ShopId
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getShopStaffByShopId($ShopId)
    {
        $data = Db::table($this->table)->where(['ShopId'=>$ShopId])->select();
        return $data;
    }

    /**
     * 通过员工id 获取员工
     * @param $Ids
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getShopStaffByNpcIds($Ids)
    {
        $data = Db::table($this->table)->where('_id','in',$Ids)->select();
        return $data;
    }

    /**
     * 获取店铺id
     * @param $ShopId
     * @return int|string
     */
    public function getShopEmployee($ShopId)
    {
        $count = Db::table($this->table)->where('ShopId',$ShopId)->count();
        if($count){
            return $count;
        }else{
            return 0;
        }
    }

    /**
     * 通过id数组获取员工
     * @param $ids
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getInfoByIds($ids)
    {
        $data = Db::table($this->table)->where('_id','in',$ids)->select();
        return $data;
    }

    /**
     * 设置员工培训属性
     * @param $staff
     * @param $shuxing
     * @return bool
     */
    public function setAttribute($staff,$shuxing)
    {
        $BasicProperties = $staff['BasicProperties'];
        $BasicProperties[1] = $BasicProperties[1] + $shuxing[1];
        $BasicProperties[2] = $BasicProperties[2] + $shuxing[2];
        $BasicProperties[3] = $BasicProperties[3] + $shuxing[3];
        $BasicProperties[4] = $BasicProperties[4] + $shuxing[4];
        $rs = Db::table($this->table)->where(['_id'=>(string)$staff['_id']])->update(['BasicProperties'=>$BasicProperties]);
        if($rs){
            //判断是否是第二天
            $Staff = new Staff();
            $IsPeixun = $Staff->getRedisTodayTrainNum($staff['Uid'],(string)$staff['_id']);
            var_dump($IsPeixun);
            if($IsPeixun){
                Db::table($this->table)->where(['_id'=>(string)$staff['_id']])->setInc('TodayTrainNum',1);

            }else{
                $Staff->setRedisTodayTrainNum($staff['Uid'],(string)$staff['_id']);
                Db::table($this->table)->where(['_id'=>(string)$staff['_id']])->update(['TodayTrainNum'=>1]);
            }
            Db::table($this->table)->where(['_id'=>(string)$staff['_id']])->setInc('TrainNum',1);
            return true;
        }else{
            return false;
        }
    }

    /**
     * 删除员工
     * @param $Ids
     * @return int
     */
    public function DelStaff($Ids)
    {
        $rs = Db::table($this->table)->where('_id','in',$Ids)->delete();
        return $rs;
    }

    /**
     * 获取员工今日是否培训过
     * @param $Uid
     * @param $StaffId
     * @return bool
     */
    public function getRedisTodayTrainNum($Uid,$StaffId)
    {
        $key = $this->key .$Uid .':' . $StaffId;
        $rs = $this->redis->get($key);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取每个员工每天的培训次数
     * @param $Uid
     * @param $StaffId
     * @return bool
     */
    public function setRedisTodayTrainNum($Uid,$StaffId)
    {
        $key = $this->key .$Uid .':' . $StaffId;
        $ttl = strtotime(date("Y-m-d",strtotime("+1 day"))) - time();
        $rs = $this->redis->setex($key,$ttl,1);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 设置员工为谈判团任职
     * @param $Uid
     * @param $StaffId
     * @return bool
     */
    public function setTalkGroupStaff($Uid,$StaffId)
    {
        $ShopId = $this->TalkGroupName;
        $rs = Db::table($this->table)->where('_id',(string)$StaffId)->update(['ShopId'=>$ShopId,'Appointed'=>true]);
        if($rs){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 批量设置员工为谈判团任职
     * @param $Uid
     * @param $StaffIds
     * @return bool
     */
    public function setTalkGroupStaffs($Uid,$StaffIds)
    {
        $ShopId = $this->TalkGroupName;
        $rs = Db::table($this->table)->where('_id','in',$StaffIds)->update(['ShopId'=>$ShopId,'Appointed'=>true]);
        if($rs){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 取消职位
     * @param $Uid
     * @param $StaffId
     * @return bool
     */
    public function CancelAppointed($Uid,$StaffId)
    {
        $rs = Db::table($this->table)->where('_id',(string)$StaffId)->update(['ShopId'=>'','Appointed'=>false]);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 取消所有谈判团员工
     * @param $Uid
     * @return bool
     */
    public function CancelAppointedAll($Uid)
    {
        $rs = Db::table($this->table)->where('Uid',$Uid)->where('ShopId',$this->TalkGroupName)->update(['ShopId'=>'','Appointed'=>false]);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 批量获取谈判团员工
     * @param $Uid
     * @return array
     */
    public function getTalkGroupStaffs($Uid)
    {
        $data  = Db::table($this->table)->field('_id')->where('Uid',$Uid)->where('ShopId',$this->TalkGroupName)->select();
        if($data){
            $StaffId = [];
            foreach ($data as $datum) {
                $StaffId[] = (string)$datum['_id'];
            }
            return $StaffId;
        }else{
            return [];
        }
    }
}