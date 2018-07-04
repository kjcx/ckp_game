<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/4
 * Time: 下午1:48
 */

namespace App\Protobuf\Req;


class RankingReq
{
    public static function decode($string)
    {
        $obj = new \AutoMsg\RankingReq();
        $obj->mergeFromString($string);
        return ['ranKingType' => $obj->getRankingType()];
    }
}