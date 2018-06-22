<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午2:39
 */

namespace App\Models\Company;


use App\Models\BagInfo\Bag;
use App\Models\Excel\Building;
use App\Models\Excel\BuildingLevel;
use App\Models\Excel\GameConfig;
use App\Models\Excel\GameEnum;
use App\Models\Excel\LandInfo;
use App\Models\Model;
use App\Models\User\Role;
use App\Protobuf\Result\TalentInfo;
use App\Traits\MongoTrait;
use MongoDB\BSON\ObjectId;
use think\Db;

class Shop extends Model
{
    use MongoTrait;
    public $table = 'ckzc.Shop';
    public $mongoTable = 'ckzc.Shop';

    public function __construct()
    {
        parent::__construct();
        $this->collection = $this->getMongoClient();
    }
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
        $Role = new Role();
        $data_role = $Role->getRole($uid);
        $RoleName = $data_role['nickname'];
        //获取公司名称
        $Company = new Company();
        $CompanyName = $Company->getCompanyName($uid);
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
        $dataCompany['RoleName'] = $RoleName;//可能掉落的道具
//        $dataCompany['Area'] = 2;//私有的2 土地竞拍的1
        //员工上线人数
        $BuildingLevel = new BuildingLevel();
        $data_BuildingLevel = $BuildingLevel->getInfoByLevel(1);
//        var_dump($data_BuildingLevel);
        $dataCompany['EmployeeLimit'] = $data_BuildingLevel['ClerkNums'];//员工上线
        $dataCompany['GoldStock'] = $data_BuildingLevel['GoldStock'];//金币库存上线
        $dataCompany['ItemStock'] = $data_BuildingLevel['ItemStock'];//道具库存上线
        $dataCompany['DirectorNums'] = $data_BuildingLevel['DirectorNums'];//经理上线
        $dataCompany['CustomerAddtion'] = $data_BuildingLevel['CustomerAddtion'];//基础客流量
//        $dataCompany['DismantleCost'] = $data_BuildingLevel['DismantleCost'];//差拆费用
//        $dataCompany['UpgradeCost'] = $data_BuildingLevel['UpgradeCost'];//升级需要金币
        $dataCompany['LeaderId'] = 0;//经理id
        $dataCompany['Master'] = [];//初始化经理
        $dataCompany['LeaderTime'] = 0;//雇佣开始时间
        $dataCompany['CurExtendLv'] = 0;//扩展等级
        $rs = Db::table($this->table)->insert($dataCompany);
        if($rs){
            if($data['AreaId'] == 1){//私有地区
                //设置土地状态
                $LandInfo = new LandInfo();
                $rs = $LandInfo->setPosStatus($data['Pos'],3);
            }
            //创建成功 扣除金币
            $data_ShopTypeMoney = $this->getShopTypeMoney($data['ShopType']);
            $Bag = new Bag($uid);
            $Bag->delBag($data_ShopTypeMoney['Type'],$data_ShopTypeMoney['Count']);
            return true;
        }else{
            return false;
        }
    }

    /**
     * 获取店铺
     * @param $uid
     * @param $data 类型和位置
     * @return array|false|null|\PDOStatement|string|\think\Model
     */
    public function getShop($uid,$data)
    {
        $ShopType = $data['ShopType'];
        $AreaId = $data['AreaId'];
        $Pos = $data['Pos'];
        $data= Db::table($this->table)->where(['Uid'=>$uid,'ShopType'=>$ShopType,'AreaId'=>$AreaId,'Pos'=>$Pos])->find();
        return $data;
    }

    /**
     * 获取所有店铺
     * @param $Uid
     * @param $Type
     * @return array|false|\PDOStatement|string|\think\Collection
     */
    public function getAllShop($Uid,$AreaId=1)
    {
        $data = Db::table($this->table)->where('Uid',$Uid)->where('AreaId',$AreaId)->select();
        return $data;

    }
    /**
     * 获取店铺类型对应的价格
     * @param $ShopType 店铺类型id
     * @return array
     */
    public function getShopTypeMoney($ShopType)
    {
//        var_dump("获取店铺类型对应的价格" . $ShopType);
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
//            var_dump($res['Type'] . "=>" .$res['Count']);
            $count = $Bag->getCountByItemId($res['Type']);
//            var_dump("定期用户余额" .$count );
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
//        var_dump("level:" . $level);
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

    /**
     * 店铺拆除
     * @param $Id 店铺id
     * @param $Uid 用户id
     * @return bool
     */
    public function ShopDismantle($Id,$Uid)
    {
        $rs = Db::table($this->table)->where(['_id'=>$Id,'Uid'=>$Uid])->update(['Uid'=>0]);
        if($rs){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 设置主管
     * @param $Id 店铺id
     * @param $MasterUiD 雇佣主管id
     * @return bool
     */
    public function SetMaster($Id,$MasterUiD)
    {
        $where['_id'] = new ObjectId($Id);
        $update = ['$set' =>['Master'=>[$MasterUiD],'LeaderTime'=>time()]];
        $rs = $this->collection->updateOne($where,$update);
        if($rs){
            $Role = new Role();
            $rs = $Role->setShopid($MasterUiD,$Id);
        }
        return true;
    }

    /**
     * 验证店铺主管数量
     * @param $ShopId
     * @return bool
     */
    public function CheckMasterNum($ShopId)
    {
        $data = $this->getInfoById($ShopId);
        if($data){
            $count = count($data['Master']);//店铺主管数量
            $DirectorNums = $this->getMasterNum($ShopId);//店铺最大主管数量
            if($count <  $DirectorNums){
                //可以雇佣
                return true;
            }else{
                return false;
            }
        }
    }

    /**
     * 获取店铺主管数量
     * @param $ShopId
     * @return mixed
     */
    public function getMasterNum($ShopId)
    {
        $data = $this->getInfoById($ShopId);
        return $data['DirectorNums'];
    }

    /**
     * 获取雇佣经理 客流
     * @param $MasterUid
     * @return float|int
     */
    public function getCustomerAddtionByUid($MasterUid)
    {
        $shenjiazhi = 1000;
        $res= 10000 * (( 1 + sqrt($shenjiazhi) + $shenjiazhi)/8000);
//        var_dump("获取雇佣经理客流" . $res);
        if(!$res){
            $res = 1;
        }
        return $res;
    }

    /**
     * 获取当前用户所有主管
     * @param $Uid
     * @return array
     */
    public function getMasterByUid($Uid)
    {
        $data = Db::table($this->table)->field('Master')->where('Uid',$Uid)->select();
        $MasterId = [];
        if($data){
            foreach ($data as $datum) {
                if(count($datum['Master'])){
                    $MasterId[] = $datum['Master'][0];
                }else{
                    $MasterId = [];
                }

            }
        }
        $Role = new Role();
        $data_role = $Role->getRoleByUids($MasterId);
        $TalentDatas = [];
        if($data_role){
            foreach ($data_role as $item) {
                $TalentDatas[] = TalentInfo::encode($item);
            }
            return $TalentDatas;
        }else{
            return $TalentDatas;
        }
    }

    /**
     * 计算雇佣消耗
     * @param $MasterId
     * @return float|int
     */
    public function getMoneyToMaster($MasterId)
    {
        $data = $this->getCustomerAddtionByUid($MasterId);
        $res  = floor(($data * 3 / 5));
        if(!$res || $res <1){
            $res = 1;
        }
//        var_dump("计算雇佣消耗". $res);
        return $res;
    }

    /**
     * 雇佣奖励
     * @param $money
     * @return float
     */
    public function EmploymentAward($money)
    {
        $GameConfig = new GameConfig();
        $data = $GameConfig->getConfig('HireRewardRate');
        $EmploymentAward = floor($money * (1 - $data['value']));
        return $EmploymentAward;
    }
    /**
     * 解雇店铺经理
     * @param $ShopId
     * @return bool
     */
    public function FireMatser($ShopId)
    {
        $rs = $this->collection->findOneAndUpdate(['_id'=>new ObjectId($ShopId)],['$set'=>['Master'=>[]]]);
        if($rs){
            return true;
        }else{
            return false;
        }
    }
}