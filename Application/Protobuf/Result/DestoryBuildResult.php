<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/14
 * Time: 下午3:27
 */

namespace App\Protobuf\Result;

/**
 * 出售店铺返回
 * Class DestoryBuildResult 1063
 * @package App\Protobuf\Result
 */
class DestoryBuildResult
{
    public static function encode($ShopId)
    {
        $DestoryBuildResult = new \AutoMsg\DestoryBuildResult();
        $DestoryBuildResult->setShopId($ShopId);
        $str = $DestoryBuildResult->serializeToString();
        return $str;
    }
}