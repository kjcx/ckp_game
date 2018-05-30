<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/14
 * Time: 下午4:19
 */

namespace App\Protobuf\Result;

/**
 * 刷新次数和上次的刷新时间
 * Class TalentMarketInfo
 * @package App\Protobuf\Result
 */
class TalentMarketInfo
{
    public static function encode($uid)
    {
        $TalentMarketInfo = new \AutoMsg\TalentMarketInfo();
        $Info = new \App\Models\Company\TalentMarketInfo();
        $data_TalentMarketInfo = $Info->getInfoByUid($uid);
        if($data_TalentMarketInfo){
            $DigCount = 0;//被挖次数
            $RefreshCount = $data_TalentMarketInfo['Num'];
            //下次自动刷新时间
            $RefreshTime = $data_TalentMarketInfo['LastTime'];//上次刷新时间
            $TalentMarketInfo->setRefreshCount($RefreshCount);
            $TalentMarketInfo->setRefreshCountTime(time());
            $TalentMarketInfo->setRefreshTime($RefreshTime);
        }else{
            $RefreshTime =  time();
            $RefreshCountTime = time();//上次刷新时间
            $TalentMarketInfo->setRefreshCount(time());
            $TalentMarketInfo->setRefreshCountTime(time());
            $TalentMarketInfo->setRefreshTime(time());
        }
        return $TalentMarketInfo;
    }
}