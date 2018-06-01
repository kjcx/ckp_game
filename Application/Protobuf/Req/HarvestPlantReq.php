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
//        LoadListId

        foreach ($obj->getHarvestPlanId()->getIterator() as $v) {
            $data['landId'][] = $v;
        }
        return $data;
    }
}