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
    public static function encode($data,$To=true)
    {
        $FriendApplyClearResult = new \AutoMsg\FriendApplyClearResult();
        $data_infos = [];
        if(count($data) == count($data, 1)){
            $data_infos[] = FriendInfo::encode($data);
        }else{
            foreach ($data as $info) {
                $data_infos[] = FriendInfo::encode($info);
            }
        }
        $FriendApplyClearResult->setInfo($data_infos);
        $FriendApplyClearResult->setTo($To);
        $str = $FriendApplyClearResult->serializeToString();
        return $str;
    }
}