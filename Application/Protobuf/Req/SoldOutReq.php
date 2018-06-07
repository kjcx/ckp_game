<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/7
 * Time: 下午6:55
 */

namespace App\Protobuf\Req;

/**
 * 下架请求
 * Class SoldOutReq
 * @package App\Protobuf\Req
 */
class SoldOutReq
{
    public static function decode($data)
    {
        $SoldOutReq = new \AutoMsg\SoldOutReq();
        $SoldOutReq->mergeFromString($data);
        $Id = $SoldOutReq->getId();
        return ['Id'=>$Id];
    }
}