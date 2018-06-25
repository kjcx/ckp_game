<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/21
 * Time: 下午5:11
 */

namespace App\Protobuf\Req;

/**
 * 请求签到的天
 * Class DaySignReq
 * @package App\Protobuf\Req
 */
class DaySignReq
{
    public static function decode($data)
    {
        $DaySignReq = new \AutoMsg\DaySignReq();
        $DaySignReq->mergeFromString($data);
        $Day = $DaySignReq->getDay();
        $arr = ['Day'=>$Day];
        return  $arr;
    }
}