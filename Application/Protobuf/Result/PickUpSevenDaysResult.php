<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/23
 * Time: 下午2:46
 */

namespace App\Protobuf\Result;

/**
 * 领取奖励签到返回
 * Class PickUpSevenDaysResult
 * @package App\Protobuf\Result
 */
class PickUpSevenDaysResult
{
    public static function encode($data)
    {
        $PickUpSevenDaysResult = new \AutoMsg\PickUpSevenDaysResult();
        $SevenDaysList = SevenDaysInfo::encode($data);
        $PickUpSevenDaysResult->setSevenDaysList($SevenDaysList);
        $str = $PickUpSevenDaysResult->serializeToString();
        return $str;
    }
}