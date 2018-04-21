<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/20
 * Time: 下午1:33
 */

namespace App\Protobuf\Req;
/** 充值
 * Class TopUpGoldReq 1101
 * @package App\Protobuf\Req
 */
class TopUpGoldReq
{
    public static function decode($data)
    {
        $TopUpGoldReq = new \AutoMsg\TopUpGoldReq();
        $TopUpGoldReq->mergeFromString($data);
        $Id = $TopUpGoldReq->getId();
        return ['Id'=>$Id];
    }
}