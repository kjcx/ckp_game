<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/8
 * Time: 上午10:45
 */

namespace App\Protobuf\Result;


class RandManorResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\RandManorResult();
        $obj->setRoleId($data['uid']);
        $obj->setTime($data['time']);
        $manors = [];
        if (!empty($data['manor'])) {
            foreach ($data['manor'] as $value) {
                $manors[] = \App\Protobuf\Result\LoadManorData::encode($value);
            }
        }
        $obj->setLoadManor($manors);
        $obj->setUserName($data['name']);
        return $obj->serializeToString();
    }
}