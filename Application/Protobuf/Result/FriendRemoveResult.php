<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/3
 * Time: 下午8:43
 */

namespace App\Protobuf\Result;

/**
 * 删除好友 1012
 * Class FriendRemoveResult
 * @package App\Protobuf\Result
 */
class FriendRemoveResult
{
    public static function encode($data)
    {
        $FriendRemoveResult = new \AutoMsg\FriendRemoveResult();
        $RoleId = $data['RoleId'];
        $FriendRemoveResult->setRoleId($RoleId);
        $str = $FriendRemoveResult->serializeToString();
        return $str;
    }
}