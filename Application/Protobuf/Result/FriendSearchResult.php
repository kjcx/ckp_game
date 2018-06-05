<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/28
 * Time: 下午1:45
 */

namespace App\Protobuf\Result;

/**
 * 搜索好友返回
 * Class FriendSearchResult 1016
 * @package App\Protobuf\Result
 */
class FriendSearchResult
{
    public static function encode($data)
    {
        $FriendSearchResult = new \AutoMsg\FriendSearchResult();
        $Friends = [];
        foreach ($data as $datum) {
            $Friends[] = FriendInfo::encode($datum);
        }
        $FriendSearchResult->setFriends($Friends);
        $str = $FriendSearchResult->serializeToString();
        return $str;
    }
}