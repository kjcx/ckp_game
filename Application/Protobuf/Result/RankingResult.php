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
    public static function encode($data,$type)
    {
        $obj = new \AutoMsg\RankingResult();
        $ranking = LoadRanking::encodeObj($data,$type);
        $obj->setLoadRanking($ranking);
        return $obj->serializeToString();
    }
}