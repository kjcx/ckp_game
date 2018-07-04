<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/3
 * Time: 上午11:54
 */

namespace App\Protobuf\Result;

use App\Models\User\Role;

/**
 * 拒绝好友返回
 * Class FriendApplyClearResult 1017
 * @package App\Protobuf\Result
 */
class FriendApplyClearResult
{
    public static function encode($data,$To=true)
    {
        $FriendApplyClearResult = new \AutoMsg\FriendApplyClearResult();

        $data_infos = [];
        foreach ($data as $info) {
            $data_infos[] = FriendInfo::encode($info);
        }
        $FriendApplyClearResult->setInfo($data_infos);
        $FriendApplyClearResult->setTo($To);
        $str = $FriendApplyClearResult->serializeToString();
        return $str;
    }
}