<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/19
 * Time: 上午11:37
 */

namespace App\Protobuf\Result;

/**
 * 签到信息
 * Class LoadSignInfo
 * @package App\Protobuf\Result
 */
class LoadSignInfo
{
    public static function encode($data)
    {
        $LoadSignInfo = new \AutoMsg\LoadSignInfo();
        $LoadSignInfo->setDay($data['Day']);
        $LoadSignInfo->setIsSign($data['IsSign']);
        return $LoadSignInfo;
    }
}