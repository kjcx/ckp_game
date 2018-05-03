<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/2
 * Time: 下午2:44
 */

namespace App\Protobuf\Req;

/**
 * 通过好友申请
 * Class FriendAddReq 1022
 * @package App\Protobuf\Req
 */
class FriendAddReq
{
    public static function decode($data)
    {
        $FriendAddReq = new \AutoMsg\FriendAddReq();
        $FriendAddReq->mergeFromString($data);
        $RoleIds = $FriendAddReq->getRoleIds()->getIterator();
        $arr =[];
        foreach ($RoleIds as $roleId) {
            $arr[] = $roleId;
        }
        return $arr;
    }
}