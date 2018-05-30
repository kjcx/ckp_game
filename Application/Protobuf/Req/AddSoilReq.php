<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/29
 * Time: 下午2:45
 */

namespace App\Protobuf\Req;


class AddSoilReq
{
    /**
     * 解码
     */
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\AddSoilReq();
        $obj->mergeFromString($string);
        $data['landId'] = $obj->getId();
        return $data;
    }
}