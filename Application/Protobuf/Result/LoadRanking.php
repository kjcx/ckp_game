<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/4
 * Time: 下午3:24
 */

namespace App\Protobuf\Result;


class LoadRanking
{
    public static function encodeObj($data,$type)
    {
        $obj = new \AutoMsg\LoadRanking();
        $ranking = RankdataListProto::encodeObj($data);
        $obj->setRanking([$type => $ranking]);
        return $obj;
    }
}