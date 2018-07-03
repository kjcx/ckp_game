<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/2
 * Time: 下午7:55
 */

namespace App\Protobuf\Result;


class RoomVisitInfo
{
    public static function encodeObj($data)
    {
        $obj = new \AutoMsg\RoomVisitInfo();
        $obj->setRoleId($data['roleId']);
        $obj->setName($data['roleName']);
        $obj->setTime($data['time']);
        $obj->setType($data['type']);
        $obj->setValue1(1);
        $obj->setValue2(2);
        $obj->setValue3(3);
        $obj->setStatus($data['value']);
        return $obj;
    }
}