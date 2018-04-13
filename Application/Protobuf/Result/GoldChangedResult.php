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
    public static function encode()
    {
        $GoldChangedResult = new \AutoMsg\GoldChangedResult();
        $GoldChangedResult->setGold();//金币
    }
}