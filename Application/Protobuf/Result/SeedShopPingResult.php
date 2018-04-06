<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/6
 * Time: 下午3:09
 */
namespace App\Protobuf\Result;
/**
 * 种子商店购买返回
 * Class SeedShopPingResult 1108
 * @package App\Protobuf\Result
 */
class SeedShopPingResult
{
    public function decode($data)
    {
        $SeedShopPingResult = new \AutoMsg\SeedShopPingResult();
        $SeedShopPingResult->mergeFromString($data);
        $SeedShopPingResult->setItemId();
        $SeedShopPingResult->setItemCount();
        $SeedShopPingResult->setPrice();
        $str = $SeedShopPingResult->serializeToString();
        return $str;
    }
}