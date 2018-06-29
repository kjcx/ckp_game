<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/28
 * Time: 下午2:44
 */

namespace App\Protobuf\Req;


class FurnitureStarReq
{
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\FurnitureStarReq();
        $obj->mergeFromString($string);
        $data['id'] = $obj->getId();
        return $data;
    }
}