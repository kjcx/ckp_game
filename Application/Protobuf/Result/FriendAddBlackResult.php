<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/6
 * Time: 下午7:31
 */

namespace App\Protobuf\Result;

/**
 * 加入黑名单返回
 * Class FriendAddBlackResult
 * @package App\Protobuf\Result
 */
class FriendAddBlackResult
{
    public static function encode($data)
    {
        $FriendAddBlackResult = new \AutoMsg\FriendAddBlackResult();
        $Info = FriendInfo::encode($data);
        $FriendAddBlackResult->setRole($Info);
        $str = $FriendAddBlackResult->serializeToString();
        return $str;
    }
}