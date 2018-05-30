<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/30
 * Time: 下午5:00
 */

namespace App\Protobuf\Req;


class HarvestPlantReq
{
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\HarvestPlantReq();
        $obj->mergeFromString($string);
        $data['landId'] = $obj->getHarvestPlanId();
        return $data;
    }
}