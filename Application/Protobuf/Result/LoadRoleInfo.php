<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 下午12:43
 */
namespace App\Protobuf\Result;
use App\Models\User\Role;

class LoadRoleInfo
{
    public static function encode($uid)
    {
        $role = new Role();
        $arr = $role->getRole($uid);
        var_dump($arr);
        $Name = $arr['nickname'];
        $RoleId = $arr['id'];
        $Sex = $arr['sex'];
        $Icon = $arr['icon'];
        $Exp = $arr['exp'];
        $Level = $arr['level'];
        $LoadRoleInfo = new \AutoMsg\LoadRoleInfo();
        $LoadRoleInfo->setName($Name);
        $LoadRoleInfo->setRoleId($RoleId);
        $LoadRoleInfo->setSex($Sex);
        $LoadRoleInfo->setIcon($Icon);
        $LoadRoleInfo->setExp($Exp);
        $LoadRoleInfo->setLevel($Level);
//        $LoadRoleInfo->set
        $str = $LoadRoleInfo->serializeToString();
        return $LoadRoleInfo;
    }
}