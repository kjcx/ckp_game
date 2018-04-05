<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 下午1:11
 */
namespace App\Protobuf\Result;
class MissionResult
{
    public static function encode()
    {
        $MissionResult = new \AutoMsg\MissionResult();
        $VitalityStatus = $MissionResult->getVitalityStatus();
        $VitalityStatus[0] = true;
        $MissionResult->setVitalityStatus($VitalityStatus);
        return $MissionResult;
    }
}