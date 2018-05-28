<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/23
 * Time: 下午5:06
 */

namespace App\Protobuf\Result;

/**
 * 返款
 * Class LoansInfo
 * @package App\Protobuf\Result
 */
class LoansInfo
{
    public static function encode($data)
    {
        var_dump($data);
        $LoansInfo = new \AutoMsg\LoansInfo();
        $Id = (string)$data['_id'];
        $Day = $data['Day'];
        $GoldCount = $data['GoldCount'];
        $GoldType = $data['GoldType'];
        $LoansTime = $data['CreateTime'];
        $WhetherTheLoan = $data['WhetherTheLoan'];
        $LoansInfo->setDay($Day);
        $LoansInfo->setGoldCount($GoldCount);
        $LoansInfo->setGoldType($GoldType);
        $LoansInfo->setId($Id);
        $LoansInfo->setLoansTime($LoansTime);
        $LoansInfo->setWhetherTheLoan($WhetherTheLoan);
        return $LoansInfo;
    }
}