<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/2
 * Time: 下午6:57
 */

namespace App\Protobuf\Result;


class RoleVisitInfo
{
    public static function encodeObj($data)
    {
        var_dump($data);
        $obj = new \AutoMsg\RoleVisitInfo();
        $obj->setRoleId($data['RoleId']);
        $obj->setIcon($data['Icon']);
        $obj->setName($data['Name']);
        $obj->setSex($data['Sex']);
        $obj->setVipLevel($data['VipLevel']);
        $obj->setSocialStatus($data['SocialStatus']);
        $obj->setAvatar($data['Avatar']);//迭代
        $obj->setRoomPraiseTime($data['RoomPraiseTime']);
        $obj->setAchieve($data['Achieve']);
        $obj->setVipId($data['VipId']);
        return $obj;
    }
}