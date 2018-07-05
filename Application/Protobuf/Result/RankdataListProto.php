<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/4
 * Time: 下午3:27
 */

namespace App\Protobuf\Result;


class RankdataListProto
{
    public static function encodeObj($data)
    {
        $obj = new \AutoMsg\RankdataListProto();
        $RankDataProtoList = [];
        foreach ($data as $d) {
            $RankDataProtoList[] = RankDataProto::encodeObj($d);
        }
        $obj->setRankDataProtoList($RankDataProtoList);
        return $obj;
    }
}