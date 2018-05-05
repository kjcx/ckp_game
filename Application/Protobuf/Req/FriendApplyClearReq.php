<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/3
 * Time: 上午11:52
 */

namespace App\Protobuf\Req;

/**
 * 拒绝好友申请
 * Class FriendApplyClearReq 1025
 * @package App\Protobuf\Req
 */
class FriendApplyClearReq
{
    public static function decode($data)
    {
        $FriendApplyClearReq = new \AutoMsg\FriendApplyClearReq();
        $FriendApplyClearReq->mergeFromString($data);
        return [];
    }

}