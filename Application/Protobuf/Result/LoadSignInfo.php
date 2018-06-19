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
    public static function ecode($data)
    {
        $LoadSignInfo = new \AutoMsg\LoadSignInfo();
        $Day = $data['Day'];
        $IsSign = $data['IsSign'];
        $LoadSignInfo->setDay($Day);
        $LoadSignInfo->setIsSign($IsSign);
        return $LoadSignInfo;
    }
}