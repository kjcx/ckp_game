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

    public static function drop($arr)
    {
        foreach ($arr as $item) {
            foreach ($item as $k =>$v) {
                $LoadDropData = new \AutoMsg\LoadDropData();
                $LoadDropData->setId($v['Id']);
                $LoadDropData->setShopType((int)$v['ShopType']);
                $LoadDropData->setCount((string)$v['Count']);
                $LoadDropData->setDiscountedPrice($v['DiscountedPrice']);//打折价格
                $LoadDropData->setDropKuId($v['DropKuId']);
                $LoadDropData->setGridId($v['GridId']);
                $data[] = $LoadDropData;
            }
        }
//        var_dump($data);
        return $data;
    }
    public static function result_drop($arr){
        $LoadDropData = new \AutoMsg\LoadDropData();
        $LoadDropData->setId($arr['ItemId']);
        $LoadDropData->setShopType($arr['ShopTypeId']);
        $LoadDropData->setCount(1);
//        $LoadDropData->setDiscountedPrice($arr['DiscountedPrice']);//打折价格
        $LoadDropData->setDropKuId($arr['DropKuId']);
        $LoadDropData->setGridId($arr['GridId']);
        return $LoadDropData;
    }
}