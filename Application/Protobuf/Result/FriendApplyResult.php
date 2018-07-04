<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/28
 * Time: 下午2:12
 */

namespace App\Protobuf\Result;
use App\Models\User\FriendApply;
use App\Models\User\Role;

/**
 * 申请好友返回
 * Class FriendApplyResult 1011
 * @package App\Protobuf\Result
 */
class FriendApplyResult
{
    public static function encode($data,$To=true,$Applyed=false)
    {
        $FriendApplyResult = new \AutoMsg\FriendApplyResult();
        $Info = [];
        if($data){
            $Info = FriendInfo::encode($data);
        }else{
            $Info = new \AutoMsg\FriendInfo();
        }
        $FriendApplyResult->setInfo($Info);//申请人信息
        $FriendApplyResult->setTo($To);//是否是自己发出的添加
        $FriendApplyResult->setApplyed($Applyed);
        $str = $FriendApplyResult->serializeToString();
        return $str;
    }
}