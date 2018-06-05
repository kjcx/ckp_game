<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/26
 * Time: 下午5:32
 */

namespace App\Protobuf\Result;

use App\Models\LandInfo\MyLandInfo;

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
        $MyLandInfo = new MyLandInfo();
        var_dump(111);
        $data = $MyLandInfo->getPosInfoByPos($pos);
        var_dump($data);
        $AuctionLandInfo = AuctionLandInfo::encode($data);
        $AuctionLandResult->setAuctionLandInfo($AuctionLandInfo);
        $str = $AuctionLandResult->serializeToString();
        return $str;
    }
}