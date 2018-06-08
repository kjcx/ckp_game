<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/7
 * Time: 下午6:50
 */

namespace App\Protobuf\Req;

/**
 * 交易购买请求
 * Class UserBuyReq
 * @package App\Protobuf\Req
 */
class UserBuyReq
{
    public static function decode($data)
    {
        $UserBuyReq = new \AutoMsg\UserBuyReq();
        $UserBuyReq->mergeFromString($data);
        $Id = $UserBuyReq->getId();
        $Count = $UserBuyReq->getCount();
        return ['Id'=>$Id,'Count'=>$Count];
    }
}