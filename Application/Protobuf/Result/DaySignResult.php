<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/21
 * Time: 下午5:23
 */

namespace App\Protobuf\Result;


class DaySignResult
{
    public static function encode()
    {
        $DaySignResult = new \AutoMsg\DaySignResult();
        $DaySignResult->setLoaSignInfo();
    }
}