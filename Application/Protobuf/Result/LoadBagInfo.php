<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 下午1:26
 */
namespace App\Protobuf\Result;
class LoadBagInfo
{
    public static function encode()
    {
        $LoadBagInfo = new \AutoMsg\LoadBagInfo();
        return $LoadBagInfo;
    }
}