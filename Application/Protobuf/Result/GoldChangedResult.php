<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午12:48
 */
namespace App\Protobuf\Result;
/**
 * 金币变换通知
 * Class GoldChangedResult 1065
 * @package App\Protobuf\Result
 */
class GoldChangedResult
{
    public static function encode($gold)
    {
        $GoldChangedResult = new \AutoMsg\GoldChangedResult();
        $GoldChangedResult->setGold($gold);//金币
        $str = $GoldChangedResult->serializeToString();
        return $str;
    }
}