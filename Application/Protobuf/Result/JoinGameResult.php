<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 上午11:50
 */
namespace App\Protobuf\Result;

use App\Models\User\FriendApply;

class JoinGameResult
{
    public static function encode($arr)
    {
        $uid = $arr['uid'];
        $JoinGameResult = new \AutoMsg\JoinGameResult();
        //设置角色信息
        var_dump("设置角色信息");
        var_dump($uid);
        $str_role = LoadRoleInfo::encode($uid);
        $JoinGameResult->setLoadRoleInfo($str_role);
        //设置服务器时间
        $LoadServerConfig = LoadServerConfig::encode();
        $JoinGameResult->setServerConfig($LoadServerConfig);
        //设置任务信息
        $MissionResult = MissionResult::encode();
//        var_dump($MissionResult);
        $JoinGameResult->setMission($MissionResult);
        //背包信息
        $LoadBagInfo = LoadBagInfo::encode($uid);
        $JoinGameResult->setRoleBag($LoadBagInfo);
        //技能列表
        $SkillResult = SkillResult::encode();
        $JoinGameResult->setSkillResult($SkillResult);
        //每日充值限额
        $DayCountInfo = DayCountInfo::encode();
        $JoinGameResult->setDayCountInfo($DayCountInfo);
        //好友
        $FriendApply = new FriendApply();
        $data_Friends = $FriendApply->getFriends($uid);
        var_dump("haoyou00");
        var_dump($data_Friends);
        $Friend = FriendListResult::encode($data_Friends);
        $JoinGameResult->setFriend($Friend);
        $str = $JoinGameResult->serializeToString();
        return $str;
    }
}