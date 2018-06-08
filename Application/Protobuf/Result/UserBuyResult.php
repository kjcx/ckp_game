<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/7
 * Time: 下午6:52
 */

namespace App\Protobuf\Result;

/**
 * 用户购买返回
 * Class UserBuyResult
 * @package App\Protobuf\Result
 */
class UserBuyResult
{
    public static function encode($data)
    {
        $UserBuyResult = new \AutoMsg\UserBuyResult();
        $Goods = DealGoodsUpdate::encode($data);
        $UserBuyResult->setGoods($Goods);
        $str = $UserBuyResult->serializeToString();
        return $str;
    }
}