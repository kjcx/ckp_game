<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/23
 * Time: 下午8:33
 */

namespace App\Protobuf\Result;

/**
 * 任务数据
 * Class MissionDataResult
 * @package App\Protobuf\Result
 */
class MissionDataResult
{
    public static function encode($data)
    {
        $MissionDataResult = new \AutoMsg\MissionDataResult();
        $arr = [];
        foreach ($data as $k => $datum) {
//            $Complete = $datum['Complete'];//完成状态
            $MissId = $datum['MissId'];//完成状态
//            $Progress = $datum['Progress'];//完成状态
            $GetReward = $datum['GetReward'];//完成状态
//            $MissionDataResult->setComplete($Complete);
//            $MissionDataResult->setGetReward($GetReward);
            $MissionDataResult->setMissId($MissId);
//            $MissionDataResult->setProgress($Progress);
            $arr[$MissId] = $MissionDataResult;
        }
        return $arr;

    }
}