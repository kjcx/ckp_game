<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 上午10:39
 */

namespace App\Protobuf\Result;

/** 加载用户的数据信息
 * Class LoadRefStaff
 * @package App\Protobuf\Result
 */
class LoadRefStaff
{
    public static function encode($data)
    {
        var_dump("======加载用户的数据信息======");
        $LoadRefStaff = new \AutoMsg\LoadRefStaff();
        if($data){
            $ShopId = $data['ShopId'];
            $Id = (string)$data['_id'];
            $Name = $data['Name'];
            $Pos = $data['Pos'];
            $NpcId = $data['NpcId'];
            $EmployersDate = $data['EmployersDate'];
            $ComprehensionTime = $data['ComprehensionTime'];
            $Appointed = $data['Appointed'];
            $BasicProperties = $data['BasicProperties'];
            $LevelUpTime = $data['LevelUpTime'];
            $LoadRefStaff->setShopId($ShopId);
            $LoadRefStaff->setId($Id);
            $LoadRefStaff->setName($Name);
            $LoadRefStaff->setPos($Pos);//任职岗位
            $LoadRefStaff->setNpcId($NpcId);
            $LoadRefStaff->setEmployersDate($EmployersDate);//雇佣日期
            $LoadRefStaff->setComprehensionTime(15);//可培训次数
            $LoadRefStaff->setAppointed($Appointed);//是否已任职
            $LoadRefStaff->setBasicProperties($BasicProperties);//基础属性：
            $LoadRefStaff->setLevelUpTime($LevelUpTime);//升级次数
        }
        return $LoadRefStaff;
    }
}