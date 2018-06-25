<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/12
 * Time: 下午6:58
 */

namespace App\Protobuf\Result;


use App\Models\Company\Shop;
use App\Models\LoadData\LandBuildInfo;

class BuildLvUpResult
{
    public static function encode($ShopId)
    {
        $BuildLvUpResult = new \AutoMsg\BuildLvUpResult();
        $LandBuildInfo = LandBuildInfo::getOne($ShopId);
        $BuildLvUpResult->setLandBuildInfo($LandBuildInfo);
        $str = $BuildLvUpResult->serializeToString();
        return $str;
    }
}