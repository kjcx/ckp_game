<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/3
 * Time: 下午8:24
 */

namespace App\Protobuf\Req;

/** 删除好友
 * Class FriendRemoveReq 1023
 * @package App\Protobuf\Req
 */
class FriendRemoveReq
{
    public static function decode($data)
    {
        $FriendRemoveReq = new \AutoMsg\FriendRemoveReq();
        $FriendRemoveReq->mergeFromString($data);
        $RoleId = $FriendRemoveReq->getRoleId();
        return ['RoleId'=>$RoleId];
    }
}