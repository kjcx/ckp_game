<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/26
 * Time: 下午5:32
 */

namespace App\Protobuf\Result;

use App\Models\Execl\LandInfo;

/**
 * 竞拍请求返回 2008
 * Class AuctionLandResult
 * @package App\Protobuf\Result
 */
class AuctionLandResult
{
    public static function encode($pos)
    {
        $AuctionLandResult = new \AutoMsg\AuctionLandResult();
        $LandInfo = new LandInfo();
        $data = $LandInfo->getPosInfoByPos($pos);
        $AuctionLandInfo = AuctionLandInfo::encode($data);
        $AuctionLandResult->setAuctionLandInfo($AuctionLandInfo);
        $str = $AuctionLandResult->serializeToString();
        return $str;
    }
}