<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/24
 * Time: 下午7:36
 */

namespace App\Protobuf\Req;

/**
 * 快速完成
 * Class MissionFirstCompleteReq 1149
 * @package App\Protobuf\Req
 */
class MissionFirstCompleteReq
{
    public static function decode($data)
    {
        $MissionFirstCompleteReq = new \AutoMsg\MissionFirstCompleteReq();
        $MissionId = $MissionFirstCompleteReq->getMissionId();
        return ['MissionId'=>$MissionId];
    }
}