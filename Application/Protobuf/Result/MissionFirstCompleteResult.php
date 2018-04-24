<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/24
 * Time: 下午7:39
 */

namespace App\Protobuf\Result;

/**
 * 快速完成任务返回
 * Class MissionFirstCompleteResult 1202
 * @package App\Protobuf\Result
 */
class MissionFirstCompleteResult
{
    public static function encode($data)
    {
        $MissionFirstCompleteResult = new \AutoMsg\MissionFirstCompleteResult();
        $MissionId = $data['MissionId'];
        $MissionFirstCompleteResult->setMissionId($MissionId);
        $str = $MissionFirstCompleteResult->serializeToString();
        return $str;
    }
}