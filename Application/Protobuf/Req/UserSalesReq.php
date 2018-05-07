<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/4
 * Time: 上午9:52
 */

namespace App\Protobuf\Req;

/**
 * 用户寄卖
 * Class UserSalesReq
 * @package App\Protobuf\Req
 */
class UserSalesReq
{
    public static function decode($data)
    {
        $UserSalesReq = new \AutoMsg\UserSalesReq();
        $UserSalesReq->mergeFromString($data);
        $Id = $UserSalesReq->getId();
        $Count = $UserSalesReq->getCount();
        $DealType = $UserSalesReq->getDealType();
        $GoldType = $UserSalesReq->getGoldType();
        $Price = $UserSalesReq->getPrice();
        return ['Id'=>$Id,'Count'=>$Count,'DealType'=>$DealType,'GoldType'=>$GoldType,'Price'=>$Price];
    }
}