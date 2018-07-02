<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/2
 * Time: 下午3:21
 */

namespace App\Protobuf\Result;


class RoomLiveResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\RoomLiveResult();
        $room = RoomResult::encodeObj($data);
        $obj->setRoom($room);
        return $obj->serializeToString();
    }
}