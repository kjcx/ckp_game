<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午6:42
 */

namespace App\Protobuf\Result;


use App\Models\Company\Shop;
use App\Models\LoadData\LandBuildInfo;

/**
 * 获得店铺信息
 * Class GetMapResult
 * @package App\Protobuf\Result
 */
class GetMapResult
{
    public static function encode($uid)
    {
        $GetMapResult = new \AutoMsg\GetMapResult();
        $LandBuildInfo = LandBuildInfo::encode($uid);
        $GetMapResult->setLoadBuildInfo($LandBuildInfo);
//        $str = $GetMapResult->serializeToString();
        return $GetMapResult;
    }
}