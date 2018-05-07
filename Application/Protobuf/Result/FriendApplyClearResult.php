<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/3
 * Time: 上午11:54
 */

namespace App\Protobuf\Result;

/**
 * 拒绝好友返回
 * Class FriendApplyClearResult 1017
 * @package App\Protobuf\Result
 */
class FriendApplyClearResult
{
    public static function encode($data)
    {
        $FriendApplyClearResult = new \AutoMsg\FriendApplyClearResult();
        $str = $FriendApplyClearResult->serializeToString();
        return $str;
    }
}