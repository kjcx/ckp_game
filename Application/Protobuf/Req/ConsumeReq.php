<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午7:58
 */

namespace App\Protobuf\Req;

/**
 * 获取收获的店铺id
 * Class ConsumeReq
 * @package App\Protobuf\Req
 */
class ConsumeReq
{
    public static function decode($data)
    {
        $ConsumeReq = new \AutoMsg\ConsumeReq();
        $ConsumeReq->mergeFromString($data);
        $data = $ConsumeReq->getShopId()->getIterator();
        $ShopIds = [];
        foreach ($data as $datum) {
            $ShopIds[] = $datum;
        }
        return $ShopIds;
    }
}