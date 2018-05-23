<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/21
 * Time: 下午9:58
 */

namespace App\Protobuf\Req;

/**
 * 获取所有无主店铺
 * Class NoBodyShopReq 1158
 * @package App\Protobuf\Req
 */
class NoBodyShopReq
{
    public static function decode($data)
    {
        $NoBodyShopReq = new \AutoMsg\NoBodyShopReq();
        $NoBodyShopReq->mergeFromString($data);
        $Page = $NoBodyShopReq->getPage();
        $ShopType = $NoBodyShopReq->getShopType();
        return ['Page'=>$Page,'ShopType'=>$ShopType];
    }
}