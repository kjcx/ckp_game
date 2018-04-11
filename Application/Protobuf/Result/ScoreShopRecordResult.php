<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/10
 * Time: 下午1:51
 */
namespace App\Protobuf\Result;
/**
 * 积分商店日志
 * Class ScoreShopRecordResult
 * @package App\Protobuf\Result
 */
class ScoreShopRecordResult
{
    public static function encode()
    {
        $ScoreShopRecordResult = new \AutoMsg\ScoreShopRecordResult();
        $ScoreShopRecordResult->setScore();
        $ScoreShopRecordResult->setTime();
        $ScoreShopRecordResult->setType();
        $ScoreShopRecordResult->setValue1();
        $ScoreShopRecordResult->setValue2();
        $ScoreShopRecordResult->setValue3();
        $str = $ScoreShopRecordResult->serializeToString();
        return $str;
    }
}