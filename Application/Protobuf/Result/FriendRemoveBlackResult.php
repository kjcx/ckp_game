<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/13
 * Time: 下午6:25
 */

namespace App\Protobuf\Result;

/**
 * 移除黑名单
 * Class FriendRemoveBlackResult
 * @package App\Protobuf\Result
 */
class FriendRemoveBlackResult
{
    public static function encode($Uid)
    {
        $FriendRemoveBlackResult = new \AutoMsg\FriendRemoveBlackResult();
        $FriendRemoveBlackResult->setRoleId($Uid);
        $str = $FriendRemoveBlackResult->serializeToString();
        return $str;
    }
}