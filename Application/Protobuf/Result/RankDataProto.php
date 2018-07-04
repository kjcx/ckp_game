<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/4
 * Time: 下午3:18
 */

namespace App\Protobuf\Result;


class RankDataProto
{
    public static function encodeObj($data)
    {
        $obj = new \AutoMsg\RankDataProto();
        $obj->setIcon($data['icon']);
        $obj->setName($data['name']);
        $obj->setRoleId($data['uid']);
        $obj->setRank($data['rank']);
        $obj->setValue($data['value']);
        $obj->setValue1($data['value1']);
        $obj->setValue2($data['value2']);
        $obj->setValue3($data['value3']);
        return $obj;
    }
}