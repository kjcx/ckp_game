<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/21
 * Time: 上午11:35
 */

namespace App\Protobuf\Req;


class RoomReq
{
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\RoomReq();
        $obj->mergeFromString($string);
        $data['uid'] = $obj->getRoleId();
        return $data;
    }
}