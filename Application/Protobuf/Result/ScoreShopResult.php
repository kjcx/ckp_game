<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/10
 * Time: 下午1:46
 */
namespace  App\Protobuf\Result;
/**
 * 请求积分商店返回
 * Class ScoreShopResult 1193
 * @package App\Protobuf\Result
 */
class ScoreShopResult
{
    public static function encode()
    {
        $ScoreShopResult = new \AutoMsg\ScoreShopResult();
        $ScoreShopResult->setRefshTime(time());
//        $ScoreShopResult->setBuyInfo();
//        $ScoreShopResult->setScoreRecords();
        $str = $ScoreShopResult->serializeToString();
        return $str;
    }
}