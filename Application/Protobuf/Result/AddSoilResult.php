<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/29
 * Time: 下午7:17
 */

namespace App\Protobuf\Result;


class AddSoilResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\AddSoilResult();
        $obj->setId((int)$data['id']);
        return $obj->serializeToString();
    }
}