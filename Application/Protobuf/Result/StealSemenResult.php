<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/8
 * Time: 下午8:27
 */

namespace App\Protobuf\Result;


class StealSemenResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\StealSemenResult();
        $LoadListId = [];
        foreach ($data as $v) {
            $LoadListId[] = LoadListId::encode($v);
        }
        $obj->setLoadHarvestCount($LoadListId);
        return $obj->serializeToString();
    }
}