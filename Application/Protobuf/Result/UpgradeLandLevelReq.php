<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/1
 * Time: 下午11:00
 */

namespace App\Protobuf\Result;


class UpgradeLandLevelReq
{
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\UpgradeLandLevelReq();
        $obj->mergeFromString($string);
        $data['landId'] = $obj->getId();
        return $data;
    }
}