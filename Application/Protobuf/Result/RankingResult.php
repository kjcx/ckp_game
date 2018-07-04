<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/4
 * Time: 下午1:53
 */

namespace App\Protobuf\Result;


class RankingResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\RankingResult();
        $obj->setLoadRanking();
        return $obj->serializeToString();
    }
}