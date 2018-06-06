<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/6
 * Time: 下午7:26
 */

namespace App\Protobuf\Req;

/**
 * 加入黑名单
 * Class FriendAddBlackReq
 * @package App\Protobuf\Req
 */
class FriendAddBlackReq
{
    public static function decode($data)
    {
        $FriendAddBlackReq = new \AutoMsg\FriendAddBlackReq();
        $FriendAddBlackReq->mergeFromString($data);
        $RoleId = $FriendAddBlackReq->getRoleId();
        return ['RoleId'=>$RoleId];
    }
}