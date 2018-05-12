<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午2:39
 */

namespace App\Models\Company;


use App\Models\BagInfo\Bag;
use App\Models\Execl\Building;
use App\Models\Execl\BuildingLevel;
use App\Models\Execl\GameEnum;
use App\Models\Model;
use App\Models\User\Role;
use think\Db;

class Shop extends Model
{
    public $table = 'Shop';

    public function getShopType()
    {
        $GameEnum = new GameEnum();
        $data = $GameEnum->where(['type'=>'ShopType'])->find();

    }
    /**
     * 创建店铺
     * @param $uid
     * @param $data
     * @return bool
     */
    public function create($uid,$data)
    {
        //获取公司名称
        $Company = new Company();
        $CompanyName = $Company->getCompanyName($uid);
        var_dump($data);
        $dataCompany['Employee'] = 0;//员工数
        $dataCompany['GetMoney'] = 0;//今日产出
        $dataCompany['Level'] = 1;//等级
        $dataCompany['Uid'] = $uid;//
        $dataCompany['CompanyName'] = $CompanyName;//公司名字
        $dataCompany['Pos'] = $data['Pos'];
        $dataCompany['AreaId'] = $data['AreaId'];
        $dataCompany['ShopType'] = $data['ShopType'];
        $Building = new Building();
        $data_Building = $Building->getType($data['ShopType']);
        $dataCompany['Name'] = $data_Building['Name'];
        $dataCompany['Income'] = $data_Building['Income'];//身价
        $dataCompany['OutputItem'] = $data_Building['OutputItem'];//可能掉落的道具
        $dataCompany['CreateTime'] = time();//可能掉落的道具
        //员工上线人数
        $BuildingLevel = new BuildingLevel();
        $data_BuildingLevel = $BuildingLevel->getInfoByLevel(1);
        var_dump($data_BuildingLevel);
        $dataCompany['EmployeeLimit'] = $data_BuildingLevel['ClerkNums'];//员工上线
        $dataCompany['GoldStock'] = $data_BuildingLevel['GoldStock'];//金币库存上线
        $dataCompany['ItemStock'] = $data_BuildingLevel['ItemStock'];//道具库存上线
        $dataCompany['DirectorNums'] = $data_BuildingLevel['DirectorNums'];//经理上线
        $dataCompany['CustomerAddtion'] = $data_BuildingLevel['CustomerAddtion'];//基础客流量
//        $dataCompany['DismantleCost'] = $data_BuildingLevel['DismantleCost'];//差拆费用
//        $dataCompany['UpgradeCost'] = $data_BuildingLevel['UpgradeCost'];//升级需要金币
        $dataCompany['LeaderId'] = 0;//经理id
        $dataCompany['LeaderTime'] = 0;//雇佣开始时间
        $dataCompany['CurExtendLv'] = 0;//扩展等级
        $rs = Db::table($this->table)->insert($dataCompany);
        if($rs){
            //创建成功 扣除金币
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取店铺
     * @param $uid
     * @param $ShopType
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getShop($uid,$ShopType)
    {
        $data= Db::table($this->table)->where(['Uid'=>$uid,'ShopType'=>$ShopType])->find();
        return $data;
    }

    /**
     * 获取所有店铺
     * @param $Uid
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getAllShop($Uid)
    {
        $data = Db::table($this->table)->where('Uid',$Uid)->select();
        return $data;

    }
    /**
     * 获取店铺类型对应的价格
     * @param $ShopType 店铺类型id
     * @return array
     */
    public function getShopTypeMoney($ShopType)
    {
        var_dump("获取店铺类型对应的价格" . $ShopType);
        $Building = new Building();
        $data = $Building->getBuildingCost($ShopType);
        if($data){
            return ['Type'=>$data['Type'],'Count'=>$data['Count']];
        }else{
            return false;
        }

    }

    /**
     * 验证金币是否足够创建
     * @param $uid
     * @param $ShopType
     * @return bool
     */
    public function CheckMoney($uid,$ShopType)
    {
        $res = $this->getShopTypeMoney($ShopType);
        $Bag = new Bag($uid);
        if($res){
            var_dump($res['Type'] . "=>" .$res['Count']);
            $count = $Bag->getCountByItemId($res['Type']);
            if($count >= $res['Count']){
                //允许创建
                return true;
            }else{
                //不允许创建
                return false;
            }
        }
    }

    /**
     * 验证等级是否符合
     * @param $uid 用户id
     * @param $ShopType
     * @return bool
     */
    public function CheckLevel($uid,$ShopType)
    {
        $Building = new Building();
        $level = $Building->getNeedLv($ShopType);
        var_dump("level:" . $level);
        if(!$level){
            return false;
        }
        $role = new Role();
        $data_level = $role->getLevel($uid);
        if($data_level['level'] >= $level){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 通过id获取信息
     * @param $Uid
     * @param $Id
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getInfoById($Id,$Uid=0)
    {
        $data = Db::table($this->table)->where(['_id'=>$Id])->find();
        return $data;
    }

    /**
     * 升级店铺
     * @param $Id
     * @param $UpdateLevel
     * @param $data_BuildingLevel
     * @return bool
     */
    public function UpdateLevel($Id,$data_BuildingLevel)
    {
        $update['Level'] = $data_BuildingLevel['Id'];//等级
        $update['EmployeeLimit'] = $data_BuildingLevel['ClerkNums'];//员工上线
        $update['GoldStock'] = $data_BuildingLevel['GoldStock'];//金币库存上线
        $update['ItemStock'] = $data_BuildingLevel['ItemStock'];//道具库存上线
        $update['DirectorNums'] = $data_BuildingLevel['DirectorNums'];//经理上线
        $update['CustomerAddtion'] = $data_BuildingLevel['CustomerAddtion'];//基础客流量
        $update['Income'] = $data_BuildingLevel['Income'];//身价
//        $update['OutputItem'] = $data_BuildingLevel['OutputItem'];//可能掉落的道具

        $rs = Db::table($this->table)->where(['_id'=>$Id])->update($update);
        if($rs){
            return true;
        }else{
            return false;
        }
    }
}