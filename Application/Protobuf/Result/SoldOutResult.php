<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/7
 * Time: 下午6:56
 */

namespace App\Protobuf\Result;

/**
 * 下架请求返回
 * Class SoldOutResult
 * @package App\Protobuf\Result
 */
class SoldOutResult
{
    public static function encode($Id)
    {
        $SoldOutResult = new \AutoMsg\SoldOutResult();
        $SoldOutResult->setId($Id);
        $str = $SoldOutResult->serializeToString();
        return $str;
    }
}