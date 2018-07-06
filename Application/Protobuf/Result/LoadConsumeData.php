<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午8:45
 */

namespace App\Protobuf\Result;

/**
 * 店铺产出道具
 * Class LoadConsumeData
 * @package App\Protobuf\Result
 */
class LoadConsumeData
{
    public static function encode($data)
    {
        $LoadConsumeData = new \AutoMsg\LoadConsumeData();
        $ShopId = $data['ShopId'];
//        $Money = $data['Money'];
//        $MoneyType = $data['MoneyType'];
        $ItemCount = $data['ItemCount'];
        $map = [];
        foreach ($ItemCount as $item) {
            $map[$item['ItemId']] = $item['Count'];
        }
        $HarvestDate = $data['OutputGoldDate'];
        $ItmeDate = $data['PurchaseItmeDate'];
        $LoadConsumeData->setShopId($ShopId);//店铺id
//        $LoadConsumeData->setMoney($Money);//产出的钱
//        $LoadConsumeData->setMoneyType($MoneyType);//产出的钱的类型
        $LoadConsumeData->setItemCount($map);//产出的道具
        $LoadConsumeData->setHarvestDate($HarvestDate);//设置金币收获时间
        $LoadConsumeData->setItmeDate($ItmeDate);//道具产出时间
        return $LoadConsumeData;
    }
}