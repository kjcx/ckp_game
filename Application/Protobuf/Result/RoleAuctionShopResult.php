<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/24
 * Time: 下午3:04
 */

namespace App\Protobuf\Result;

/**
 * 自己竞拍过的所有店铺
 * Class RoleAuctionShopResult 1189
 * @package App\Protobuf\Result
 */
class RoleAuctionShopResult
{
    public static function ecode($data)
    {
        $RoleAuctionShopResult = new \AutoMsg\RoleAuctionShopResult();
        $RoleAuctionShopResult->setRoleAuctionShop();
        $str = $RoleAuctionShopResult->serializeToString();
        return $str;
    }
}