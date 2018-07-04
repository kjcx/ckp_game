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
        $DealGoodsUpdate->setId((string)$data['_id']);//记录id
        $DealGoodsUpdate->setItemId($data['ItemId']);//道具id
        $DealGoodsUpdate->setCount($data['Count']);//道具数量
        $DealGoodsUpdate->setPrice($data['Price']);//价格
        $DealGoodsUpdate->setGoldType($data['GoldType']);//钱类型
        $DealGoodsUpdate->setType($data['Type']);//道具类型
        $DealGoodsUpdate->setUpTime($data['UpTime']);//上架时间
//        $DealGoodsUpdate->setCurPrice();//当前价格
        return $DealGoodsUpdate;
    }
}