<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/2
 * Time: 下午2:57
 */

namespace App\Protobuf\Result;

/**
 * 通过好友申请返回
 * Class FriendAddResult 1013
 * @package App\Protobuf\Result
 */
class FriendAddResult
{
    public static function encode($infos,$To=1)
    {
        $FriendAddResult = new \AutoMsg\FriendAddResult();
        $FriendAddResult->setTo($To);
        $data_infos = [];

        foreach ($infos as $info) {
            $data_infos[] = FriendInfo::encode($info);
        }
        $FriendAddResult->setInfos($data_infos);
        $str = $FriendAddResult->serializeToString();
        return $str;
    }
}