<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/26
 * Time: 下午5:48
 */

namespace App\Protobuf\Req;

/**
 * 竞拍请求返回
 * Class AuctionLandReq
 * @package App\Protobuf\Req
 */
class AuctionLandReq
{
    public static function decode($data)
    {
        $AuctionLandReq = new \AutoMsg\AuctionLandReq();
        $AuctionLandReq->mergeFromString($data);
        $Pos = $AuctionLandReq->getPos();
        return ['Pos'=>$Pos];
    }
}