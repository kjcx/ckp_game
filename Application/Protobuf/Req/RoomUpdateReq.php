<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/30
 * Time: 下午5:00
 */

namespace App\Protobuf\Req;


class RoomUpdateReq
{
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\RoomUpdateReq();
        $obj->mergeFromString($string);
        $data['roomId'] = $obj->getId();
        return $data;
    }
}