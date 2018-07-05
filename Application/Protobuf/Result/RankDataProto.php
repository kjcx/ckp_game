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
        $obj->setWin($data['win']);
        $obj->setCommerceName($data['commercename']);
        $obj->setPKPingCount($data['pkcount']);
        $obj->setLevel($data['level']);
        $obj->setIncome($data['income']);
        return $obj;
    }
}