<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/21
 * Time: 上午10:20
 */

namespace App\Protobuf\Result;


class RoomResult
{
    /**
     * 返回类型
     * @param $value
     * @param int $return
     * @return \AutoMsg\RoomResult
     */
    public static function encodeObj($value)
    {
        $obj = new \AutoMsg\RoomResult();
        $obj->setRoleId($value['uid']);
        $obj->setConfig($value['config']);
        $obj->setRoomId($value['roomId']);
        return $obj;
    }

    /**
     * 返回二进制字符串
     * @param $value
     * @return string
     */
    public static function encode($value)
    {
        $obj = new \AutoMsg\RoomResult();
        $obj->setRoleId($value['uid']);
        $obj->setConfig($value['config']);
        $obj->setRoomId($value['roomId']);
        return $obj->serializeToString();
    }
}