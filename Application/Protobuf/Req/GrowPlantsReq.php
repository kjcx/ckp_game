<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/29
 * Time: 下午9:24
 */

namespace App\Protobuf\Req;


class GrowPlantsReq
{
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\GrowPlantsReq();
        $obj->mergeFromString($string);
        $data['id'] = $obj->getId();
        $data['semenId'] = $obj->getSemenId();
        return $data;
    }
}