<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 下午12:58
 */
namespace App\Protobuf\Result;

class LoadServerConfig
{
    public static function encode()
    {
        $LoadServerConfig = new \AutoMsg\LoadServerConfig();
        $LoadServerConfig->setServerTime(time());
        return $LoadServerConfig;
    }
}