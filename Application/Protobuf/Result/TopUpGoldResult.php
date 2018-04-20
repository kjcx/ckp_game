<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/20
 * Time: 下午1:36
 */

namespace App\Protobuf\Result;

/**
 * 返回是否充值成功
 * Class TopUpGoldResult 1140
 * @package App\Protobuf\Result
 */
class TopUpGoldResult
{
    public static function encode($data)
    {
        $TopUpGoldResult = new \AutoMsg\TopUpGoldResult();
        $TopUpGoldResult->setIsSuccessful(true);
        $str = $TopUpGoldResult->serializeToString();
        return $str;
    }
}