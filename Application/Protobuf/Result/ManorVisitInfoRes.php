<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/23
 * Time: 下午3:21
 */

namespace App\Protobuf\Result;


class ManorVisitInfoRes
{
    public static function encode($value)
    {
        var_dump($value);
        $obj = new \AutoMsg\ManorVisitInfoRes();
        $obj->setStatus($value['status']);
        $obj->setTime($value['time']);
        $obj->setRoleId($value['uid']);
        $obj->setName($value['name']);
        $obj->setItmeCount($value['itmecount']);
        $obj->setType($value['type']);
        $obj->setValue1('value1');
        $obj->setValue2('value2');
        return $obj;
    }
}