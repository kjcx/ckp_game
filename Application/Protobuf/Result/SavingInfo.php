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
        $Id = (string)$data['_id'];
        $GoldType = $data['GoldType'];
        $Earnings = $data['Earnings'];
        $GoldCount = $data['GoldCount'];
        $LoadingTime = $data['LoadingTime'];
        $SavingInst = (double)$data['SavingInst'];
        $SavingTime = $data['SavingTime'];
        $SavingType = $data['SavingType'];
        $TimeLimit = $data['TimeLimit'];
        $SavingInfo->setId($Id);
        $SavingInfo->setGoldType($GoldType);
        $SavingInfo->setEarnings($Earnings);
        $SavingInfo->setGoldCount($GoldCount);
        $SavingInfo->setLoadingTime($LoadingTime);
        $SavingInfo->setSavingInst($SavingInst);
        $SavingInfo->setSavingTime($SavingTime);
        $SavingInfo->setSavingType($SavingType);
        $SavingInfo->setTimeLimit($TimeLimit);
        return $SavingInfo;
    }
}