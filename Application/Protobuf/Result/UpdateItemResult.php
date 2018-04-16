<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 下午6:54
 */
namespace App\Protobuf\Result;
/**
 * 道具更新
 * Class UpdateItemResult 1022
 * @package App\Protobuf\Result
 */
class UpdateItemResult
{
    public static function encode()
    {
        $UpdateItemResult = new \AutoMsg\UpdateItemResult();
        $items[1011] = 0;
        $items[1021] = 0;
        $UpdateItemResult->setItemUpdate($items);
        $str = $UpdateItemResult->serializeToString();
        return $str;
    }
}