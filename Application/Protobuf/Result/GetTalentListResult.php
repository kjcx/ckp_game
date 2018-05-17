<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/12
 * Time: 下午4:13
 */

namespace App\Protobuf\Result;

use App\Models\User\Role;

/**
 * 人才市场列表返回
 * Class GetTalentListResult 1176
 * @package App\Protobuf\Result
 */
class GetTalentListResult
{
    public static function encode($uid)
    {
        $GetTalentListResult = new \AutoMsg\GetTalentListResult();
        $data = [];
        //随机查询人才市场列表
        //判断刷新时间是否到
        // 到了更新没到读取之前数据
        $TalentMarketInfo = new \AutoMsg\TalentMarketInfo();

        $Info = new \App\Models\Company\TalentMarketInfo();
        $data_TalentMarketInfo = $Info->getInfoByUid($uid);

        $DigCount = 0;//被挖次数
        $RefreshCount = $data_TalentMarketInfo['Num'];
        //下次自动刷新时间
        $data_TalentMarketTime = $Info->getTalentMarketTime();
        $value = $data_TalentMarketTime['value'] * 60;
        $More = time()- $data_TalentMarketInfo['LastTime'] - $value > 0;
        if($data_TalentMarketInfo['LastTime'] == '' ||  $More){
            $RefreshTime =  time();
            $IsFree = true;
            $TalentMarketInfo = new \App\Models\Company\TalentMarketInfo();
            var_dump("更新上一次刷新时间");
            $update_LastTime = $TalentMarketInfo->setLastTime($uid);
        }else{
            $RefreshTime = $data_TalentMarketInfo['LastTime'];
            $IsFree = false;
        }
        $Role = new Role();
        $data = $Role->getListByRand($IsFree);
        $List = [];
        foreach ($data as $datum) {
            $List[] = TalentInfo::encode($datum);
        }
        $Info = TalentMarketInfo::encode($uid);
        $GetTalentListResult->setInfo($Info);
        $GetTalentListResult->setList($List);
        $str = $GetTalentListResult->serializeToString();
        return $str;
    }
}