<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 下午2:02
 */

namespace App\Protobuf\Req;

/**
 * 水果机抽奖请求
 * Class RaffleFruitsReq 1035
 * @package App\Protobuf\Req
 */
class RaffleFruitsReq
{
    public static function decode($data)
    {
        $RaffleFruitsReq = new \AutoMsg\RaffleFruitsReq();
//        $RaffleFruitsReq->mergeFromString($data);
//        $Id = $RaffleFruitsReq->getId();
//        return ['Id'=>$Id];
    }
}