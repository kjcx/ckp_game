<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午8:54
 */

namespace App\Models\Company;


use App\Models\Excel\BuildingLevel;
use App\Models\FriendInfo\FriendInfo;
use App\Models\Model;
use App\Models\Staff\Staff;
use App\Models\User\Role;
use think\Db;

/**
 * 店铺收益
 * Class ConsumeResult
 * @package App\Models\Company
 */
class ConsumeResult extends Model
{
    public $table  = 'ckzc.ConsumeResult';
    public $type = [1=>'DiteDropProps',2=>'DigitalropProps',3=>'ClothingDiteDropProps',4=>'DisportDiteDropProps',5=>'GemDropProps'];
    /**
     * 获取收益
     */
    public function getConsumeResult($Uid,$ShopId)
    {
        //计算收益
        $num = $this->getAllCustomerAddtion($Uid,$ShopId);
        $BuildingLevel = new BuildingLevel();
        $Shop = new Shop();
        $data_shop = $Shop->getInfoById($ShopId);
        $data_item = $BuildingLevel->getInfoByLevel($data_shop['Level']);
        $Count = floor($data_item['Count'] * (1 + $num/500));
        $ShopType = $data_shop['ShopType'];
        $data_rand_item = $BuildingLevel->getRand($data_shop['Level']);
        $Field = $this->type[$ShopType];
        return ['ItemId'=>$data_item['ItemId'],'Count'=>$Count];
    }

    /**
     * 创建收益
     * @param $data
     * @return int|string
     */
    public function create($data)
    {
//        $LoadConsumeData->setShopId();//店铺id
//        $LoadConsumeData->setMoney();//产出的钱
//        $LoadConsumeData->setMoneyType();//产出的钱的类型
//        $LoadConsumeData->setItemCount();//产出的道具
//        $LoadConsumeData->setHarvestDate();//收获时间
//        $LoadConsumeData->setItmeDate();//道具产出时间
        $data['Uid'] = 37;//
        $data['ShopId'] = 1;//
        $data['Money'] = 1;//
        $data['MoneyType'] = 6;//
        $data['ItemCount'] = [151=>1];//
        $data['HarvestDate'] = time();//
        $data['ItmeDate'] = time()- 2*3600;//
        $rs = Db::table($this->table)->insert($data);
        return $rs;
    }

    /**
     * 获取全部客流量
     * @param $Uid
     * @param $ShopId
     * @return float|int
     */
    public function getAllCustomerAddtion($Uid,$ShopId)
    {
        $Staff = new Staff();
        $StaffCustomerAddtion = $Staff->getStaffCustomerAddtionByShopId($Uid,$ShopId);//员工加成
        $Role = new Role();
        $info = $Role->getLevel($Uid);
        $Level = $info['level'];
        $BuildingLevel = new BuildingLevel();
        $data_BuildingLevel = $BuildingLevel->getInfoByLevel($Level);
        $CustomerAddtion = $data_BuildingLevel['CustomerAddtion'];//基础客流量
        //店铺经理 身价值 加成
        $Shop = new Shop();
        $MasterId = $Shop->getMaster($ShopId);
        $Master_jiaceng = 0;
        if($MasterId){
            $User = $Role->getShenjiazhi($MasterId);
            $sjz = $User['shenjiazhi'];
            $a = (int)((1000 * (1 + sqrt($sjz)) + $sjz) /8000);
            //判断经理和本人是不是好友 是好友取友情值
            $Friend = new FriendInfo();
            $rs = $Friend->checkIsFriend($Uid,$MasterId);
            if($rs){
                //是好友
                $FriendValue = 1;
                $Master_jiaceng = (sqrt($FriendValue) + $FriendValue/4);
            }else{
                $Master_jiaceng = 0;
            }
        }

        $keliuliang = $CustomerAddtion + $StaffCustomerAddtion + $Master_jiaceng;
        return $keliuliang;
    }
}