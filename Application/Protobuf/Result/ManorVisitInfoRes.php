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

        $obj = new \AutoMsg\ManorVisitInfoRes();
        $obj->setStatus($value['status']);
        $obj->setTime($value['time']);
        $obj->setRoleId($value['uid']);
        $obj->setName($value['name']);
        $obj->setItmeCount($value['itmeCount']);
        $obj->setType($value['type']);
        $obj->setValue1('');
        $obj->setValue2('');
        return $obj;
    }
}