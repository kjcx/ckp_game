<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/13
 * Time: 下午6:24
 */

namespace App\Protobuf\Req;

/**
 * 移除黑名单
 * Class FriendRemoveBlackReq
 * @package App\Protobuf\Req
 */
class FriendRemoveBlackReq
{
    public static function decode($data)
    {
        $FriendRemoveBlackReq = new \AutoMsg\FriendRemoveBlackReq();
        $FriendRemoveBlackReq->mergeFromString($data);
        $Uid = $FriendRemoveBlackReq->getRoleId();
        return ['Uid'=>$Uid];
    }
}