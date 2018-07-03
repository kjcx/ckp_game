<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/2
 * Time: 下午3:44
 */

namespace App\Protobuf\Result;


class RoomVisitResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\RoomVisitResult();
        $room = RoomResult::encodeObj($data['room']);
        $obj->setRoom($room);
        $visitinfo = RoleVisitInfo::encodeObj($data['visitinfo']);
        $obj->setRole($visitinfo);
        return $obj->serializeToString();
    }
}