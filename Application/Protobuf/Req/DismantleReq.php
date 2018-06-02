<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/1
 * Time: 下午1:36
 */

namespace App\Protobuf\Req;


class DismantleReq
{
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\DismantleReq();
        $obj->mergeFromString($string);
        $data['uid'] = $obj->getUserId();
        $data['landId'] = $obj->getId();
        return $data;
    }
}