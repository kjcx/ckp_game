<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/24
 * Time: 下午5:18
 */

namespace App\Protobuf\Req;

/**
 * 获取今日拍卖土地信息 2004
 * Class GetAuctionLandReq 2004
 * @package App\Protobuf\Req
 */
class GetAuctionLandReq
{
    public static function decode($data)
    {
        $GetAuctionLandReq = new \AutoMsg\GetAuctionLandReq();
        $GetAuctionLandReq->getZone();
        return ;
    }
}