<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午12:29
 */
namespace App\Protobuf\Result;
class LoadDropData
{
    public static function encode($shopType)
    {
        $LoadDropData = new \App\Models\LoadData\LoadDropData();
        $arr = $LoadDropData->getShopType($shopType);
        $LoadDropData = new \AutoMsg\LoadDropData();
        foreach ($arr as $k =>$v) {
            $LoadDropData->setId($v['Id']);
            $LoadDropData->setShopType($v['Type']);
            $LoadDropData->setCount(['Count']);
            $LoadDropData->setDiscountedPrice(0);//打折价格
            $LoadDropData->setDropKuId(0);
            $LoadDropData->setGridId();
            $data[] = $LoadDropData;
        }
        return $data;

    }
}