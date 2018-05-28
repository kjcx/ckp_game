<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/23
 * Time: 下午4:07
 */

namespace App\Protobuf\Req;

/**
 * 贷款请求
 * Class LoansReq 1152
 * @package App\Protobuf\Req
 */
class LoansReq
{
    public static function decde($data)
    {
        $LoansReq = new \AutoMsg\LoansReq();
        $LoansReq->mergeFromString($data);
        $Day = $LoansReq->getDay();
        $GoldCount = $LoansReq->getGoldCount();
        $GoldType = $LoansReq->getGoldType();
        return ['Day'=>$Day,'GoldCount'=>$GoldCount,'GoldType'=>$GoldType];
    }
}