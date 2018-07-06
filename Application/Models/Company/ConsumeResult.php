<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午8:54
 */

namespace App\Models\Company;


use App\Models\Excel\BuildingLevel;
use App\Models\Excel\Drop;
use App\Models\Excel\GameConfig;
use App\Models\FriendInfo\FriendInfo;
use App\Models\Model;
use App\Models\Staff\Staff;
use App\Models\Store\DropStaff;
use App\Models\Store\DropStore;
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
        //获取上次收获时间
        $Shop = new Shop();
        $data_shop = $Shop->getInfoById($ShopId);

        $PurchaseItmeDate = $data_shop['PurchaseItmeDate'];//道具收获时间
        $OutputGoldDate = $data_shop['OutputGoldDate'];//金币收获时候

        $GameConfig = new GameConfig();
        $ItemInterval = $GameConfig->getItemInterval();//店铺道具产出间隔
        $GoldInterval = $GameConfig->getGoldInterval();//金币产出时间
        $Gold_num = (time() - $OutputGoldDate) % ($GoldInterval * 60);
        $Item_num = (time() - $PurchaseItmeDate) % ($ItemInterval * 60);
        $num = $this->getAllCustomerAddtion($Uid,$ShopId);
        $BuildingLevel = new BuildingLevel();

        $data_item = $BuildingLevel->getInfoByLevel($data_shop['Level']);
        $Count = floor($data_item['GoldStock'] * (1 + $num/500));//金币

        $Gold = $Count * $Gold_num;//金币时间

        $ShopType = $data_shop['ShopType'];
        $Field = $this->type[$ShopType];
        //读取对应的字段
        $str = $data_item[$Field];
        $arr = explode(';',$str);
        $list = [];
        $Gold2 = [];
        for ($i=0;$i<$Item_num;$i++){
            //计算非绑金收益
            $data_rand_item = $BuildingLevel->getRand($data_shop['Level']);//非绑金
            if($data_rand_item){
                if(isset($Gold2[$data_rand_item['ItemId']])){
                    $Gold2[$data_rand_item['ItemId']] =  $Gold2[$data_rand_item['ItemId']] + $data_rand_item['Count'];
                }else{
                    $Gold2[$data_rand_item['ItemId']] = $data_rand_item['Count'];
                }
            }

            //计算收益
            $new = [];
            foreach ($arr as $item) {
                $res = explode(',',$item);
                $DropId = $res[0];
                $num = $res[1];
                for($i=0;$i<$num;$i++){
                    $new[] = $DropId;
                }
            }

            mt_srand();
            $DropId = $new[array_rand($new)];
            $Drop = new Drop();
            $data_drop = $Drop->getRandDropLib($DropId);//道具
            if($data_drop){
                if(isset( $list[$data_drop['ItemId']])){
                    $list[$data_drop['ItemId']] =  $list[$data_drop['ItemId']] + $data_drop['Count'];
                }else{
                    $list[$data_drop['ItemId']] =  $data_drop['Count'];
                }
            }
        }
        if($Count){
            $data_drop[6] = $Count;
        }
        if($Gold2){
            $list[$Gold2[2]] = $Gold2['Count'];
        }

        return ['ShopId'=>$ShopId,'ItemCount'=>$list,'PurchaseItmeDate'=>($PurchaseItmeDate + $Item_num * 60),'OutputGoldDate'=>$OutputGoldDate + $Gold_num *60];
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