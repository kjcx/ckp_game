<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/25
 * Time: 下午4:16
 */

namespace App\Protobuf\Result;

/**
 * 公司信息
 * Class LoadCompanyInfo
 * @package App\Protobuf\Result
 */
class LoadCompanyInfo
{
    public static function encode($data)
    {
        $LoadCompanyInfo = new \AutoMsg\LoadCompanyInfo();
        if($data){
            $Name = $data['Name'];
            $Desc = $data['Desc'];
            $Icon = $data['Icon'];
            $Level = $data['Level'];
            if(!isset($data['NpcId'])){
               $data['NpcId'] = [];//谈判团助战
            }
            $NpcId = $data['NpcId'];//谈判团助战
            if(!isset($data['TalkGroupId'])){
                $data['TalkGroupId'] = [];
            }
            $TalkGroupId = $data['TalkGroupId'];//谈判团队伍
            $ClientValue = $data['ClientValue']?:0;
//            var_dump('ClientValueClientValue');
            $ShopNumber = $data['ShopNumber']?:0;
            $StaffNumber = $data['StaffNumber']?:0;
            $CompanyValue = $data['CompanyValue']?:0;
            $CreateTime = $data['CreateTime'];//时间戳
            $LoadCompanyInfo->setName($Name);
            $LoadCompanyInfo->setDesc($Desc);//公司描述

            $LoadCompanyInfo->setClientValue($ClientValue);//客流量
            $LoadCompanyInfo->setShopNumber($ShopNumber);// 店铺数量
            $LoadCompanyInfo->setStaffNumber($StaffNumber);//当前员工数量
            $LoadCompanyInfo->setCompanyValue($CompanyValue);//公司身价
            $LoadCompanyInfo->setCreateTime($CreateTime);//创建时间
            $LoadCompanyInfo->setNpcId($NpcId);
            $LoadCompanyInfo->setTalkGroupId($TalkGroupId);
        }
        return $LoadCompanyInfo;
    }
}