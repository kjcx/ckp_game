<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 下午1:11
 */
namespace App\Protobuf\Result;
use App\Models\Execl\Mission;

class MissionResult
{
    public static function encode()
    {
        $MissionResult = new \AutoMsg\MissionResult();
        $VitalityStatus = $MissionResult->getVitalityStatus();
        $VitalityStatus[0] = true;
        $Mission = new Mission();
        $data = $Mission->getMissionByLevel(0);
        var_dump($data);
        $arr = [];
        foreach ($data as $datum) {
//            $Complete = 1;//完成状态
            $MissId = $datum['Id'];//完成状态
//            $Progress = [0=>1,1=>2,2=>1];//完成状态
            $GetReward =100;//完成状态
//            $arr[] = ['MissId'=>$MissId,'Complete'=>$Complete,'Progress'=>$Progress,'GetReward'=>$GetReward];
            $arr[$MissId] = ['MissId'=>$MissId,'GetReward'=>$GetReward];
        }
        $Doings =  MissionDataResult::encode($arr);
        $MissionResult->setDoings($Doings);
        $MissionResult->setCreateRoad(1);
        $MissionResult->setVitalityStatus($VitalityStatus);
        $MissionResult->setVitality(1);
        return $MissionResult;
    }
}