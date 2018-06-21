<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/21
 * Time: 上午10:18
 */

namespace App\Protobuf\Result;


class RoomListResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\RoomListResult();
        $rooms = [];
        foreach ($data as $v) {
            $rooms[] = RoomResult::encodeObj($v);
        }
        $obj->setRooms($rooms);
        return $obj;
    }
}