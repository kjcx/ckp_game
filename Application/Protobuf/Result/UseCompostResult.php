<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/2
 * Time: 下午1:39
 */

namespace App\Protobuf\Result;


class UseCompostResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\UseCompostResult();
        $obj->setLoadManor(LoadManorData::encode($data));
        return $obj->serializeToString();
    }
}