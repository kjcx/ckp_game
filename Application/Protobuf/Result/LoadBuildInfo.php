<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午2:27
 */

namespace App\Protobuf\Result;

use AutoMsg\LoadBuildInfo as LoadBuildInfos;
class LoadBuildInfo
{
    public static function encode($data)
    {
        $LoadBuildInfo = new LoadBuildInfos();
        $BuildId = (string)$data['_id'];//
        $Pos = $data['Pos'];//
        $BuildType = $data['ShopType'];//
        $Name = $data['Name'];//
        $Level= $data['Level'];//
        $Employee= $data['Employee'];//员工数
        $GetMoney= $data['GetMoney'];//
        $CompanyName= $data['CompanyName'];//
        $EmployeeLimit= $data['EmployeeLimit'];//
        $LeaderId= $data['LeaderId'];//
        $LeaderTime= $data['LeaderTime'];//
        $Area= $data['AreaId'];//
        $CurExtendLv= $data['CurExtendLv'];//

        $LoadBuildInfo->setBuildId($BuildId);//店铺id
        $LoadBuildInfo->setPos($Pos);//店铺坐标
        $LoadBuildInfo->setBuildType($BuildType);//店铺类型
        $LoadBuildInfo->setName($Name);//店铺名字
        $LoadBuildInfo->setLevel($Level);//店铺等级
        $LoadBuildInfo->setEmployee($Employee);//店铺拥有员工数
        $LoadBuildInfo->setGetMoney($GetMoney);//店铺今日产出
        $LoadBuildInfo->setCompanyName($CompanyName);//公司名称
        $LoadBuildInfo->setEmployeeLimit($EmployeeLimit);//员工上线数量
        $LoadBuildInfo->setLeaderId((string)$LeaderId);//店铺经理id
        $LoadBuildInfo->setLeaderTime($LeaderTime);//店长雇佣开始时间
        $LoadBuildInfo->setArea($Area);//代表是公有的还是私有的或者其他
        $LoadBuildInfo->setCurExtendLv($CurExtendLv);//当前扩建等级
        return $LoadBuildInfo;
    }
}