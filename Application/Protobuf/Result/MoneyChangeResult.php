<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/20
 * Time: 上午11:51
 */

namespace App\Protobuf\Result;

/**
 * 兑换创客币返回
 * Class MoneyChangeResult 1111
 * @package App\Protobuf\Result
 */
class MoneyChangeResult
{
    public static function encode($data)
    {
        $MoneyChangeResult = new \AutoMsg\MoneyChangeResult();
        $ChangeTo = $data['ChangeTo'];
        $Count = $data['Count'];
        $MoneyChangeResult->setChangeTo(1);
        $MoneyChangeResult->setCount(1000);
        $str = $MoneyChangeResult->serializeToString();
        return $str;
    }
}