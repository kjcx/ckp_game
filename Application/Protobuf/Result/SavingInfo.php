<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/4
 * Time: 上午11:33
 */

namespace App\Protobuf\Result;

/**
 * 存款信息
 * Class SavingInfo
 * @package App\Protobuf\Result
 */
class SavingInfo
{
    public static function ecode($data)
    {
        $SavingInfo = new \AutoMsg\SavingInfo();
        $SavingInfo->setId();
        $SavingInfo->setGoldType();
        $SavingInfo->setEarnings();
        $SavingInfo->setGoldCount();
        $SavingInfo->setLoadingTime();
        $SavingInfo->setSavingInst();
        $SavingInfo->setSavingTime();
        $SavingInfo->setSavingType();
        $SavingInfo->setTimeLimit();
        $str = $SavingInfo->serializeToString();
        return $str;
    }
}