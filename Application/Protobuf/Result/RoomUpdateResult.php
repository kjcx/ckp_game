<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/30
 * Time: 下午5:02
 */

namespace App\Protobuf\Result;


class RoomUpdateResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\RoomUpdateResult();
        $roomResult = RoomResult::encodeObj($data);
        $obj->setRoomResult($roomResult);
        return $obj->serializeToString();
    }
}