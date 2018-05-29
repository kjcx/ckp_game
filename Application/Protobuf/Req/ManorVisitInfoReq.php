<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/23
 * Time: 下午3:18
 */

namespace App\Protobuf\Req;


class ManorVisitInfoReq
{
    public static function decode($string)
    {
        $obj = new \AutoMsg\ManorVisitInfoReq();
        $obj->mergeFromString($string);
        return [];
    }
}