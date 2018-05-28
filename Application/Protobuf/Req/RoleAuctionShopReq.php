<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/24
 * Time: 下午3:03
 */

namespace App\Protobuf\Req;

/**
 * 已拍店铺请求
 * Class RoleAuctionShopReq
 * @package App\Protobuf\Req
 */
class RoleAuctionShopReq
{
    public static function decode($data)
    {
        $RoleAuctionShopReq = new \AutoMsg\RoleAuctionShopReq();
        $RoleAuctionShopReq->mergeFromString($data);
    }
}