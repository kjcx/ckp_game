<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/2
 * Time: 上午10:57
 */

namespace App\Protobuf\Result;


class FurnitureStarResult
{
    public static function encode($data)
    {
        $obj = new \AutoMsg\FurnitureStarResult();
        $obj->setItem($data);
        return $obj->serializeToString();
    }
}