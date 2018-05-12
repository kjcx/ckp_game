<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/12
 * Time: 下午5:34
 */

namespace App\Protobuf\Req;

/**
 * 建造升级
 * Class BuildLvUpReq 1018
 * @package App\Protobuf\Req
 */
class BuildLvUpReq
{
    public static function decode($data)
    {
        $BuildLvUpReq = new \AutoMsg\BuildLvUpReq();
        $BuildLvUpReq->mergeFromString($data);
        $BuildIds = $BuildLvUpReq->getBuildId()->getIterator();
        $buildIds =[];
        foreach ($BuildIds as $buildId) {
            $buildIds[] = $buildId;
        }
        return $buildIds;
    }
}