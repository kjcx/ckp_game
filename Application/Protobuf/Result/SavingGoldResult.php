<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/4
 * Time: 上午11:32
 */

namespace App\Protobuf\Result;

/**
 * 存款返回
 * Class SavingGoldResult 1047
 * @package App\Protobuf\Result
 */
class SavingGoldResult
{
    public static function encode($data)
    {
        $SavingGoldResult = new \AutoMsg\SavingGoldResult();
        $SavingGoldResult->setSavingInfo($data);
        $str = $SavingGoldResult->serializeToString();
        return $str;
    }

}