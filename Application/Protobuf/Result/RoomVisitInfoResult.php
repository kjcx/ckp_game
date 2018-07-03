<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/2
 * Time: 下午7:53
 */

namespace App\Protobuf\Result;


class RoomVisitInfoResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\RoomVisitInfoResult();
        $visits = [];
        foreach ($data as $value) {
            $visits[] = RoomVisitInfo::encodeObj($value);
        }
        $obj->setVisits($visits);
        return $obj->serializeToString();
    }
}