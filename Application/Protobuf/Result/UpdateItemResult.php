<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 下午6:54
 */
namespace App\Protobuf\Result;
class UpdateItemResult
{
    public static function encode()
    {
        $UpdateItemResult = new \AutoMsg\UpdateItemResult();
        $UpdateItemResult->setItemUpdate();
    }
}