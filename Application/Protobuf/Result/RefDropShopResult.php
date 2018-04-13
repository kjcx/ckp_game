<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午12:25
 */
namespace App\Protobuf\Result;
class RefDropShopResult
{
    public static function encode($shopType)
    {
        $RefDropShopResult = new \AutoMsg\RefDropShopResult();
        $RefDropShopResult->setShopTypeId();//商品类型
        $RefDropShopResult->setDate(date('Y-m-d'));//日期
        $LoadConsume = LoadDropData::encode($shopType);
        $RefDropShopResult->setLoadConsume($LoadConsume);
        $RefDropShopResult->setTime(date('H:i:s'));//时间
        $str = $RefDropShopResult->serializeToString();
        return $str;
    }
}