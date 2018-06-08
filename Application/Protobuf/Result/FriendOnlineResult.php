<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/7
 * Time: 上午11:00
 */

namespace App\Protobuf\Result;


class FriendOnlineResult
{
    public static function encode($data)
    {
        $FriendOnlineResult = new \AutoMsg\FriendOnlineResult();
        $FriendOnlineResult->setRoleId($data['Uid']);
        $FriendOnlineResult->setOnline($data['Online']);
        $str = $FriendOnlineResult->serializeToString();
        return $str;
    }
}