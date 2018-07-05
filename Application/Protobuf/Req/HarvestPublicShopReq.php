<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/7/5
 * Time: 下午5:11
 */

namespace App\Protobuf\Req;

/**
 * 店铺收获
 * Class HarvestPublicShopReq
 * @package App\Protobuf\Req
 */
class HarvestPublicShopReq
{
    public static function decode($data)
    {
        $HarvestPublicShopReq = new \AutoMsg\HarvestPublicShopReq();
        $HarvestPublicShopReq->mergeFromString($data);
        $ShopIds = $HarvestPublicShopReq->getShopId()->getIterator();
        $arr = [];
        foreach ($ShopIds as $shopId) {
            $arr[] = $shopId;
        }
        return $arr;
    }
}