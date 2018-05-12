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
    public $table = 'Staff';

    /**
     * 创建员工
     * @param $Uid 用户id
     * @param $Type 员工类型
     * @param $IsFree 是否免费
     * @return bool|mixed
     */
    public function createStaff($Uid,$Type,$IsFree)
    {
        $DropStaff = new DropStaff();
        $data = $DropStaff->rand($Type,true);
        $data['Uid'] = $Uid;
        $data['CreateTime'] = time();
        $data['ShopId'] = "";
        $rs = Db::table($this->table)->insert($data);
        if($rs){
            return $data;
        }else{
            return false;
        }
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
            $rs =  Db::table($this->table)->where('Uid',$Uid)->where('Id','in',$NpcCardIds)->update(['ShopId'=>""]);
        }else{
            //调入
            $count = $this->getShopStaffCountByShopId($ShopId);//当前数量
            $new_count = count($NpcCardIds);//新调入数量
            $Shop = new Shop();
            $data_Shop = $Shop->getInfoById($ShopId);//店铺信息
            if($data_Shop['EmployeeLimit'] >= ($count + $new_count)){
                $rs =  Db::table($this->table)->where('Uid',$Uid)->where('Id','in',$NpcCardIds)->update(['ShopId'=>$ShopId]);
            }else{
                var_dump("员工数量超出");
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
        $count = Db::table($this->table)->where(['ShopId'=>$ShopId])->count();
        return $count;
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
        $data = Db::table($this->table)->where('Id','in',$Ids)->select();
        return $data;
    }
}