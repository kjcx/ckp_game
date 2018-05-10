<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午2:22
 */

namespace App\Protobuf\Req;

/**
 * 创建私有店铺
 * Class CreateBuildReq 1005
 * @package App\Protobuf\Req
 */
class CreateBuildReq
{
    public static function decode($data)
    {
        $CreateBuildReq = new \AutoMsg\CreateBuildReq();
        $CreateBuildReq->mergeFromString($data);
        $Pos = $CreateBuildReq->getPos();
        $AreaId = $CreateBuildReq->getAreaId();
        $ShopType = $CreateBuildReq->getShopType();
        return ['Pos'=>$Pos,'AreaId'=>$AreaId,'ShopType'=>$ShopType];
    }
}