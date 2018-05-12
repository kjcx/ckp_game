<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 下午4:23
 */

namespace App\Protobuf\Req;

/**
 * 招聘
 * Class RefStaffReq 1082
 * @package App\Protobuf\Req
 */
class RefStaffReq
{
    public static function decode($data)
    {
        $RefStaffReq = new \AutoMsg\RefStaffReq();
        $RefStaffReq->mergeFromString($data);
        $TypeId = $RefStaffReq->getTypeId();
        return ['TypeId'=>$TypeId];
    }
}