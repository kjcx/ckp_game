<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/12
 * Time: 下午1:54
 */
namespace App\Protobuf\Result;
/**
 * 购买时装返回
 * Class ModelClothesResult 1203
 * @package App\Protobuf\BagInfo
 */
class ModelClothesResult
{
    public static function encode($ids)
    {
        $ModelClothesResult = new \AutoMsg\ModelClothesResult();
//        $ModelClothesResult->setId([1021]);
        $ModelClothesResult->setId($ids);
        $str = $ModelClothesResult->serializeToString();
//        var_dump($str);
        return $str;
    }
}