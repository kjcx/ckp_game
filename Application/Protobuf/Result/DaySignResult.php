<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/21
 * Time: 下午5:23
 */

namespace App\Protobuf\Result;

/**
 * 签到返回 1169
 * Class DaySignResult
 * @package App\Protobuf\Result
 */
class DaySignResult
{
    public static function encode($data)
    {
        $DaySignResult = new \AutoMsg\DaySignResult();
        $LoaSignInfo[date('m',time())] = LoadSignInfo::encode($data);
        $DaySignResult->setLoaSignInfo($LoaSignInfo);
        $str = $DaySignResult->serializeToString();
        return $str;

    }
}