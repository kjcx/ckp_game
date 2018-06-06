<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/24
 * Time: 下午5:20
 */

namespace App\Protobuf\Result;
use App\Models\Execl\LandInfo;
use App\Models\LandInfo\MyLandInfo;

/**
 * 获取今日竞拍土地返回
 * Class GetAuctionLandResult 2006
 * @package App\Protobuf\Result
 */
class GetAuctionLandResult
{
    public static function encode()
    {
        $AuctionLandList = [];
        $GetAuctionLandResult = new \AutoMsg\GetAuctionLandResult();
        $LandInfoDay = new LandInfo();
        $data = $LandInfoDay->getTodayLandInfo();
        $AuctionLandList = [];
        if($data){
            foreach($data as $k =>$v){
                $AuctionLandList[] = AuctionLandInfo::encode($v);
            }
        }
        $GetAuctionLandResult->setAuctionLandList($AuctionLandList);
        $str = $GetAuctionLandResult->serializeToString();
        return $str;
    }
}