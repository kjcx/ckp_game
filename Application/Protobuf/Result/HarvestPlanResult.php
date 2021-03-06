<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/30
 * Time: 下午6:02
 */

namespace App\Protobuf\Result;


class HarvestPlanResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\HarvestPlanResult();
        $LoadListId = [];
        foreach ($data as $v) {
            $LoadListId[] = LoadListId::encode($v);
        }
        $obj->setLoadHarvestCount($LoadListId);
        return $obj->serializeToString();
    }
}