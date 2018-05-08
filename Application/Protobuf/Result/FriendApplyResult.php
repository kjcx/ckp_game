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
    public static function encode($data,$uid)
    {
        $FriendApplyResult = new \AutoMsg\FriendApplyResult();
        $RoleId = $data['RoleId'];
        $FriendApply = new FriendApply();
        //1 通过角色id获取用户id
        $Role = new Role();
        $userinfo = $Role->getRoleById($RoleId);
        $apply_id = $FriendApply->addFriendApply($uid,$userinfo['uid']);
        $FriendApplyResult->setApplyed($apply_id);//申请id
        $role = new Role();
        $userInfo = $role->getRole($uid);
        //增加申请时间和添加时间
        $userInfo['apply_time'] = time();
        $userInfo['add_time'] = 0;
        $userInfo['status'] = 2;
        $Info = FriendInfo::encode($userInfo);
        $FriendApplyResult->setInfo($Info);//申请人信息
        $FriendApplyResult->setTo(true);//是否是自己发出的添加
        $str = $FriendApplyResult->serializeToString();
        return $str;
    }
}