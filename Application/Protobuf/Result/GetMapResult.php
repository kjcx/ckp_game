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
    /**
     * @param $uid
     * @param $type 1店铺2开发区
     * @param $LoadLandInfoDic
     * @return \AutoMsg\GetMapResult
     */
    public static function encode($uid,$type=1,$LoadLandInfoDic='')
    {
        $GetMapResult = new \AutoMsg\GetMapResult();
        $LandBuildInfo = LandBuildInfo::encode($uid);
        $GetMapResult->setLoadBuildInfo($LandBuildInfo);

        if($type == 1){
            return $GetMapResult;
        }else{
//            $LandBuildInfo = new LandBuildInfo
            $GetMapResult->setLoadLandInfoDic($LoadLandInfoDic);
            $str = $GetMapResult->serializeToString();
            return $str;
        }

    }
}