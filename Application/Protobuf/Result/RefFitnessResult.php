<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/30
 * Time: 下午5:18
 */

namespace App\Protobuf\Result;


class RefFitnessResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\RefFitnessResult();
        $obj->setLoadManor(LoadManorData::encode($data));
        return $obj->serializeToString();
    }
}