<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/23
 * Time: 下午2:44
 */

namespace App\Protobuf\Req;

/**
 * 领取奖励
 * Class PickUpSevenDaysReq
 * @package App\Protobuf\Req
 */
class PickUpSevenDaysReq
{
    public static function decode($data)
    {
        $PickUpSevenDaysReq = new \AutoMsg\PickUpSevenDaysReq();
        $PickUpSevenDaysReq->mergeFromString($data);
        $Id = $PickUpSevenDaysReq->getId();
        return ['Id'=>$Id];
    }
}