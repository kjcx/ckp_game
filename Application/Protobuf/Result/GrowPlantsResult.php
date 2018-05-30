<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/30
 * Time: 下午3:42
 */

namespace App\Protobuf\Result;


class GrowPlantsResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\GrowPlantsResult();
        $obj->setLoadManor(LoadManorData::encode($data));
        return $obj->serializeToString();
    }
}