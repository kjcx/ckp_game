<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/26
 * Time: 下午1:41
 */

namespace App\Protobuf\Result;

use App\Models\Execl\LandInfo;

/**
 * 我的土地竞拍
 * Class MyLandInfoResult
 * @package App\Protobuf\Result
 */
class MyLandInfoResult
{
    public static function encode($uid)
    {
        $MyLandInfoResult = new \AutoMsg\MyLandInfoResult();
        $MyLandInfo = new LandInfo();
        $data =  $MyLandInfo->getMyLandInfo($uid);
        $MyLandInfoList = [];
        if($data){
            foreach ($data as $datum) {
                $MyLandInfoList[] = AuctionLandInfo::encode($datum);
            }
        }
        $MyLandInfoResult->setMyLandInfoList($MyLandInfoList);
        $str = $MyLandInfoResult->serializeToString();
        return $str;
    }
}