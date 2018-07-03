<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/2
 * Time: 下午3:43
 */

namespace App\Protobuf\Req;


class RoomVisitReq
{
    public static function decode($string)
    {
        $obj = new \AutoMsg\RoomVisitReq();
        $obj->mergeFromString($string);
        return ['uid' =>  $obj->getRoleId()];
    }
}