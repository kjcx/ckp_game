<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/30
 * Time: 下午5:21
 */

namespace App\Protobuf\Req;


class RefFitnessReq
{
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\RefFitnessReq();
        $obj->mergeFromString($string);
        $data['landId'] = $obj->getId();
        $data['uid'] = $obj->getUserId();
        return $data;
    }
}