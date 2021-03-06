<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午12:56
 */
namespace App\Protobuf\Req;
class DropShopPingReq
{
    public static function encode($data)
    {
        $DropShopPingReq = new \AutoMsg\DropShopPingReq();
        $DropShopPingReq->mergeFromString($data);
        $ShopTypeId = $DropShopPingReq->getShopTypeId();
        $ItemId = $DropShopPingReq->getItemId();
        $DropKuId = $DropShopPingReq->getDropKuId();
        $GridId = $DropShopPingReq->getGridId();
        return ['ShopTypeId'=>$ShopTypeId,'ItemId'=>$ItemId,'DropKuId'=>$DropKuId,'GridId'=>$GridId];
    }
}
