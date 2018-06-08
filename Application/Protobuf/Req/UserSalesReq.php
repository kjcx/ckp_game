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
        $ItemId = $UserSalesReq->getItemId();
        $Count = $UserSalesReq->getCount();
        $GoldType = $UserSalesReq->getGoldType();
        $Price = $UserSalesReq->getPrice();
        $Type = $UserSalesReq->getType();
        return ['ItemId'=>$ItemId,'Count'=>$Count,'GoldType'=>$GoldType,'Price'=>$Price,'Type'=>$Type];
    }
}