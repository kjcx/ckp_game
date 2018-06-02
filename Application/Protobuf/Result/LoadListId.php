<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/1
 * Time: 下午7:11
 */

namespace App\Protobuf\Result;


class LoadListId
{
    public static function encode($value)
    {
        $obj = new \AutoMsg\LoadListId();
        $obj->setId($value['Id']);
        $obj->setCount($value['Count']);
        $obj->setTime($value['Time']);
        $obj->setSemenId($value['SemenId']);
        return $obj;
    }
}