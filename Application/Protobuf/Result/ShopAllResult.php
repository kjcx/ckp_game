<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午1:11
 */
namespace App\Protobuf\Result;
/**
 * 返回商店信息
 * Class ShopAllResult 1145
 * @package App\Protobuf\Result
 */
class ShopAllResult
{
    public static function encode()
    {
        $ShopAllResult = new \AutoMsg\ShopAllResult();
        $ShopAllResult->setLoadConsume();
        $ShopAllResult->setTime();
        $ShopAllResult->setDate();
        $ShopAllResult->setHairdressingTime();
        $ShopAllResult->setMenSWearTime();
        $ShopAllResult->setOrnamentTime();
        $ShopAllResult->setWoMenSWearTime();
    }
}