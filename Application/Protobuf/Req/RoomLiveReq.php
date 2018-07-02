<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/2
 * Time: 下午3:18
 */

namespace App\Protobuf\Req;


class RoomLiveReq
{
    public static function deocode($string)
    {
        $obj = new \AutoMsg\RoomLiveReq();
        $obj->mergeFromString($string);
        return ['roomId' => $obj->getRoomId()];
    }
}