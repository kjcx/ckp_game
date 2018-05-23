<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/14
 * Time: 下午2:06
 */

namespace App\Protobuf\Result;

/**
 * 玩家信息
 * Class TalentInfo
 * @package App\Protobuf\Result
 */
class TalentInfo
{
    public static function encode($data)
    {
        $TalentInfo = new \AutoMsg\TalentInfo();
        $Icon = $data['icon'];//头像
        $Company = isset($data['Company'])?:'';//受雇公司
        $CompanyUserName = isset($data['CompanyUserName'])?:'';//公司所有者的姓名
        $DigCount = isset($data['DigCount'])?:0;//被挖次数
        $HireRoleId = isset($data['HireRoleId'])?:"";//雇佣者id
        $HireTime = isset($data['HireTime'])?:0;//被雇佣时间
        $LandPos = isset($data['LandPos'])?:0;//店铺地块，方便打开地图显示
        $Level = $data['level'];//等级
        $Name = $data['nickname'];//姓名
        $RoleId = $data['uid'];//角色id
        $SocialStatus = $data['shenjiazhi'];//身价值
        $Status = isset($data['Status'])?:false;//受雇状态
        $ShopId = $data['ShopId'];//
        $TalentInfo->setIcon($Icon);
        $TalentInfo->setCompany($Company);
        $TalentInfo->setCompanyUserName($CompanyUserName);
        $TalentInfo->setDigCount($DigCount);
        $TalentInfo->setHireRoleId($HireRoleId);
        $TalentInfo->setHireTime($HireTime);
        $TalentInfo->setLandPos($LandPos);
        $TalentInfo->setLevel($Level);
        $TalentInfo->setName($Name);
        $TalentInfo->setRoleId($RoleId);
        $TalentInfo->setSocialStatus($SocialStatus);
        $TalentInfo->setStatus($Status);
        $TalentInfo->setShopId($ShopId);
        return $TalentInfo;
    }
}