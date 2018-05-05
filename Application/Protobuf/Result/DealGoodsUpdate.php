<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/4
 * Time: 上午11:11
 */

namespace App\Protobuf\Result;

/**
 * 商品的最新状态
 * Class DealGoodsUpdate
 * @package App\Protobuf\Result
 */
class DealGoodsUpdate
{
    public static function encode($data)
    {
        $DealGoodsUpdate = new \AutoMsg\DealGoodsUpdate();
        $DealGoodsUpdate->setId();
        $DealGoodsUpdate->setName();
        $DealGoodsUpdate->setCount();
        $DealGoodsUpdate->setBiddingCount();
        $DealGoodsUpdate->setBiddingName();
        $DealGoodsUpdate->setCurPrice();
        $DealGoodsUpdate->setDealId();
        $DealGoodsUpdate->setDealType();
        $DealGoodsUpdate->setGoldType();
        $DealGoodsUpdate->setOwner();
        $DealGoodsUpdate->setUpTime();
        $DealGoodsUpdate->setPrice();
        $DealGoodsUpdate->setBiddingRoleId();
        $str = $DealGoodsUpdate->serializeToString();
        return $str;
    }
}