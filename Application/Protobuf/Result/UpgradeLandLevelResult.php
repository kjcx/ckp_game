<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/1
 * Time: 下午11:46
 */

namespace App\Protobuf\Result;


class UpgradeLandLevelResult
{
    public static function decode($data)
    {
        $obj = new \AutoMsg\UpgradeLandLevelResult();
        $obj->setLoadManor(LoadManorData::encode($data));
        return $obj->serializeToString();
    }
}