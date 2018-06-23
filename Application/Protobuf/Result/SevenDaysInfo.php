<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/23
 * Time: 下午2:47
 */

namespace App\Protobuf\Result;

/**
 * 领取签到奖励
 * Class SevenDaysInfo
 * @package App\Protobuf\Result
 */
class SevenDaysInfo
{
    public static function encode($data)
    {
        $SevenDaysInfo = new \AutoMsg\SevenDaysInfo();
        $SevenDaysInfo->setId($data['Id']);
        $SevenDaysInfo->setIsLogin(true);
        $SevenDaysInfo->setIsPickUp(true);
        return $SevenDaysInfo;
    }
}