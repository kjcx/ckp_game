<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 上午11:50
 */
namespace App\Protobuf\Result;

class JoinGameResult
{
    public static function encode($arr)
    {
        $uid = $arr['uid'];
        $JoinGameResult = new \AutoMsg\JoinGameResult();
        //设置角色信息
        $str_role = LoadRoleInfo::encode($uid);
        $JoinGameResult->setLoadRoleInfo($str_role);
        //设置服务器时间
        $LoadServerConfig = LoadServerConfig::encode();
        $JoinGameResult->setServerConfig($LoadServerConfig);
        //设置任务信息
//        $MissionResult = MissionResult::encode();
//        $JoinGameResult->setMission($MissionResult);
        //背包信息
        $LoadBagInfo = LoadBagInfo::encode($uid);
        $JoinGameResult->setRoleBag($LoadBagInfo);
        $str = $JoinGameResult->serializeToString();
        return $str;
    }
}