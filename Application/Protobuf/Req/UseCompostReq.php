<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/2
 * Time: 下午1:38
 */

namespace App\Protobuf\Req;


class UseCompostReq
{
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\UseCompostReq();
        $obj->mergeFromString($string);
        $data['landId'] = $obj->getId();
        return $data;
    }
}