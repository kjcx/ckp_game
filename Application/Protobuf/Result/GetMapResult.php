<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午6:42
 */

namespace App\Protobuf\Result;


use App\Models\Company\Shop;
use App\Models\LoadData\LandBuildInfo;
use AutoMsg\LoadLandInfo;

/**
 * 获得店铺信息
 * Class GetMapResult
 * @package App\Protobuf\Result
 */
class GetMapResult
{
    /**
     * @param $uid
     * @param $Area 2私有1 公共
     * @param $LoadLandInfoDic
     * @return \AutoMsg\GetMapResult
     */
    public static function encode($uid,$Area=1,$LoadLandInfoDic='')
    {
        $GetMapResult = new \AutoMsg\GetMapResult();
        $LandBuildInfo = LandBuildInfo::encode($uid,$Area);
        $GetMapResult->setLoadBuildInfo($LandBuildInfo);

        if($Area == 2){
            return $GetMapResult;
        }else{
            $arr = [];
            foreach ($LoadLandInfoDic as $k=>$item) {
                $LoadLandInfo = new LoadLandInfo();
                $LoadLandInfo->setPos($item['Pos']);
                if(isset($item['Uid'])){
                    $Uid = $item['Uid'];
                }else{
                    $Uid = 0;
                }
                $LoadLandInfo->setRoleId($Uid);
                $LoadLandInfo->setState($item['Status']);
                if(isset($item['Name'])){
                    $Name = $item['Name'];
                }else{
                    $Name = '';
                }
                $LoadLandInfo->setRoleName($Name);
                $arr[$item['Pos']] = $LoadLandInfo;
            }
            $GetMapResult->setLoadLandInfoDic($arr);
            $str = $GetMapResult->serializeToString();
            return $str;
        }

    }
}