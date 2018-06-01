<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/6
 * Time: 下午3:06
 */
namespace App\Protobuf\Req;
/**
 * 种子商店购买
 * Class SeedShopPingReq 1076
 * @package App\Protobuf\Req
 */
class SeedShopPingReq
{
    public static function decode($data)
    {
        $SeedShopPingReq = new \AutoMsg\SeedShopPingReq();
        $SeedShopPingReq->mergeFromString($data);
        $ItemId = $SeedShopPingReq->getItemId();
        $ItemCount = $SeedShopPingReq->getItemCount();
        return ['ItemId'=>$ItemId,'ItemCount'=>$ItemCount];
    }
}
