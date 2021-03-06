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
        $OutputGoldDate_History = time() - 86400;//字段没有的情况赋值
        $OutputGoldDate = isset($data_shop['OutputGoldDate'])?$data_shop['OutputGoldDate']:$OutputGoldDate_History;//金币收获时候
        var_dump("PurchaseItmeDate" . date('Y-m-d H:i:s',$PurchaseItmeDate) . '=>' . (time() - $OutputGoldDate));
        var_dump("OutputGoldDate" . date('Y-m-d H:i:s',$OutputGoldDate) . '=>' . (time() - $PurchaseItmeDate));
        $GameConfig = new GameConfig();
        $ItemInterval = $GameConfig->getItemInterval();//店铺道具产出间隔
        $GoldInterval = $GameConfig->getGoldInterval();//金币产出时间

        var_dump("GoldInterval" . $GoldInterval);
        var_dump("ItemInterval" . $ItemInterval);
        $Gold_num = floor((time() - $OutputGoldDate) / ($GoldInterval * 60));
        $Item_num = floor((time() - $PurchaseItmeDate) / ($ItemInterval * 60));
        $num = $this->getAllCustomerAddtion($Uid,$ShopId,$data_shop['Level']);
        var_dump("num:" . $num);
        $BuildingLevel = new BuildingLevel();

        $data_item = $BuildingLevel->getInfoByLevel($data_shop['Level']);
        $Count = (int)floor($data_item['GoldStock'] * (1 + $num/500));//金币
        var_dump("Count:" . $Count);
        $Gold = $Count * $Gold_num;//金币时间
        var_dump("获得金币:" . $Gold);
        $ShopType = $data_shop['ShopType'];
        $Field = $this->type[$ShopType];
        //读取对应的字段
        $str = $data_item[$Field];
        $arr = explode(';',$str);
        $list = [];
        $Gold2 = [];
        var_dump("item_num:" . $Item_num);
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
                for($j=0;$j<$num;$j++){
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
            $list[6] = $Count;
        }
        if($Gold2){
            $list[$Gold2[2]] = $Gold2['Count'];
        }

        $result =  ['ShopId'=>$ShopId,'ItemCount'=>$list,'PurchaseItmeDate'=>(int)($PurchaseItmeDate + $Item_num * $ItemInterval * 60),'OutputGoldDate'=>(int)($OutputGoldDate + $Gold_num * $GoldInterval *60)];
        var_dump($result);
        return $result;
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
     * @param $Level
     * @return float|int
     */
    public function getAllCustomerAddtion($Uid,$ShopId,$Level)
    {
        $Staff = new Staff();
        $StaffCustomerAddtion = $Staff->getStaffCustomerAddtionByShopId($Uid,$ShopId);//员工加成
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
        var_dump("客流量:CustomerAddtion" . $CustomerAddtion );
        var_dump("客流量:StaffCustomerAddtion" . $StaffCustomerAddtion );
        var_dump("客流量:Master_jiaceng" . $Master_jiaceng );
        $keliuliang = $CustomerAddtion + $StaffCustomerAddtion + $Master_jiaceng;
        return $keliuliang;
    }
}