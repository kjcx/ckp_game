<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/1
 * Time: 下午1:47
 */

namespace App\Protobuf\Result;


class DismantleResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\DismantleResult();
        $obj->setId($data['landId']);
        return $obj->serializeToString();
    }
}