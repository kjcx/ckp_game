<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午2:27
 */

namespace App\Protobuf\Result;

use AutoMsg\LoadBuildInfo as LoadBuildInfos;

/**
 * 店铺信息
 * Class LoadBuildInfo
 * @package App\Protobuf\Result
 */
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
        $LeaderTime= $data['LeaderTime']?:time();//
        $Area= $data['AreaId'];//
        $CurExtendLv= $data['CurExtendLv'];//
        $Income= $data['Income'];//
        $RoleName= $data['RoleName']?:'';//
        $Uid= $data['Uid'];//
//        $CustomerAddtion= $data['CustomerAddtion'];//
        $PurchaseItmeDate = $data['PurchaseItmeDate'];//上一次收获时间
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
        $LoadBuildInfo->setIncome($Income);//店铺身价
        $LoadBuildInfo->setRoleName($RoleName);
        $LoadBuildInfo->setRoleId($Uid);

//        $LoadBuildInfo->setOutputGoldDate();
        if(is_array($data['Master'])){
            $Master = $data['Master'];
        }else{
            $Master = [];
        }

        $LoadBuildInfo->setMaster($Master);//店铺主管列表
        //计算当前时间和上次产出时间时间价格

        $LoadBuildInfo->setItemOutput();//产出道具

        $LoadBuildInfo->setPurchaseItmeDate($PurchaseItmeDate);//店铺产出的道具的时间
        $LoadBuildInfo->setOutputGoldDate(0);//收获金币的时间

//        $LoadBuildInfo->setCustomerAddtion($CustomerAddtion);//客流量
        return $LoadBuildInfo;
    }
}