<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/28
 * Time: 下午2:10
 */

namespace App\Protobuf\Req;

/**
 * 申请加好友
 * Class FriendApplyReq 1021
 * @package App\Protobuf\Req
 */
class FriendApplyReq
{
    public static function decode($data)
    {
        $FriendApplyReq = new \AutoMsg\FriendApplyReq();
        $FriendApplyReq->mergeFromString($data);
        $RoleId = $FriendApplyReq->getRoleId();
        return ['RoleId'=>$RoleId];
    }
}