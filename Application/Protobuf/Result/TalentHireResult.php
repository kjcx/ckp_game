<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/14
 * Time: 下午4:45
 */

namespace App\Protobuf\Result;

use App\Models\User\Role;

/**
 * 雇佣返回
 * Class TalentHireResult 1177
 * @package App\Protobuf\Result
 */
class TalentHireResult
{
    public static function encode($data)
    {
        $ShopId = $data['ShopId'];
        $RoleId = $data['RoleId'];
        $Complete = $data['Complete'];
        //获取玩家信息
        $Role = new Role();
        $data_role = $Role->getRole($data['RoleId']);
        $data_role['ShopId'] = $ShopId;
        var_dump("data_roledata_roledata_role");
        var_dump($data_role);
        $Info = TalentInfo::encode($data_role);

        $TalentHireResult = new \AutoMsg\TalentHireResult();
        $TalentHireResult->setShopId($ShopId);
        $TalentHireResult->setRoleId($RoleId);
        $TalentHireResult->setInfo($Info);
        $TalentHireResult->setComplete($Complete);
        $str = $TalentHireResult->serializeToString();
        return $str;
    }
}