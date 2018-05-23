<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午2:27
 */

namespace App\Protobuf\Result;


use App\Models\Company\Shop;

/**
 * 创建公司返回
 * Class CreateBuildResult
 * @package App\Protobuf\Result
 */
class CreateBuildResult
{
    public static function encode($uid,$data)
    {
        $CreateBuildResult = new \AutoMsg\CreateBuildResult();
        $CreateBuild = new Shop();
        $data = $CreateBuild->getShop($uid,$data);
        $LandBuildInfo = LoadBuildInfo::encode($data);
        $CreateBuildResult->setLandBuildInfo($LandBuildInfo);
        $str = $CreateBuildResult->serializeToString();
        return $str;
    }
}