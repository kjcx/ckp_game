<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/24
 * Time: 下午5:20
 */

namespace App\Protobuf\Result;

/**
 * 今日竞拍
 * Class AuctionLandInfo
 * @package App\Protobuf\Result
 */
class AuctionLandInfo
{
    public static function encode($data)
    {
        $AuctionLandInfo = new \AutoMsg\AuctionLandInfo();
        $Pos = $data['Pos'];
        $AuctionRole = $data['AuctionRole'];
        $Gold = $data['Gold'];
        $AuctionLandInfo->setPos($Pos);
        $AuctionLandInfo->setAuctionRole($AuctionRole);
        $AuctionLandInfo->setGold($Gold);
        $CreateTime  = $data['CreateTime'];
        $AuctionLandInfo->setCreateTime($CreateTime);
        return $AuctionLandInfo;
    }
}