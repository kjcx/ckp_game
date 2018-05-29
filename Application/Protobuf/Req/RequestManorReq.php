<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/23
 * Time: 下午3:08
 */

namespace App\Protobuf\Req;


class RequestManorReq
{
    public static function decode($string)
    {
        $obj = new \AutoMsg\RequestManorReq();
        $obj->mergeFromString($string);
        return ['userId' => $obj->getUserId()];
    }

    public static function encode()
    {
        
    }
}