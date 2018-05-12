<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 下午3:41
 */

namespace App\Protobuf\Result;

/**
 * 招聘抽奖
 * Class RefStaffResult
 * @package App\Protobuf\Result
 */
class RefStaffResult
{
    public static function encode($data_Staff)
    {
        $RefStaffResult = new \AutoMsg\RefStaffResult();
//        $ShopId = 1;
//        $Id = 1;
//        $Name = 'kjcx';
//        $Pos = 0;
//        $NpcId = 1;
//        $EmployersDate = time();
//        $ComprehensionTime = 100;
//        $Appointed = 0;
//        $BasicProperties = [1=>1];
//        $LevelUpTime = 1;
//        $data['ShopId'] = 1;
//        $data['Id'] = 1;
//        $data['Pos'] = $Pos;
//        $data['Name'] = $Name;
//        $data['NpcId'] = $NpcId;
//        $data['EmployersDate'] = $EmployersDate;
//        $data['ComprehensionTime'] = $ComprehensionTime;
//        $data['Appointed'] = $Appointed;
//        $data['BasicProperties'] = $BasicProperties;
//        $data['LevelUpTime'] = $LevelUpTime;
        $LoadRefStaff[] = LoadRefStaff::encode($data_Staff);
        $RefStaffResult->setLoadRefStaffList($LoadRefStaff);
        $str = $RefStaffResult->serializeToString();
        return $str;
    }
}