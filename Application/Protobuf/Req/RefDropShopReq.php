<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午12:20
 */
namespace App\Protobuf\Req;
/**
 * 刷新商城商品
 * Class RefDropShopReq 1077
 * @package App\Protobuf\Req
 */
class RefDropShopReq
{
    public static function decode($data)
    {
        $RefDropShopReq = new \AutoMsg\RefDropShopReq();
        $RefDropShopReq->mergeFrom($data);
        $ShopTypeId = $RefDropShopReq->getShopTypeId();
        return $ShopTypeId;
    }
}