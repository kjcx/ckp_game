<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 下午12:43
 */
namespace App\Protobuf\Result;
use App\Models\User\Role;
use App\Models\User\UserAttr;

class LoadRoleInfo
{
    public static function encode($uid)
    {
        $role = new Role();
        $arr = $role->getRole($uid);
//        var_dump($arr);
        $Name = $arr['nickname'];
        $RoleId = $arr['uid'];
        $Sex = $arr['sex'];
        $Icon = $arr['icon'];
        $Exp = $arr['exp'];
        $Level = $arr['level'];
        $Desc = $arr['sign'];
        $LoadRoleInfo = new \AutoMsg\LoadRoleInfo();
        $LoadRoleInfo->setName($Name);
        $LoadRoleInfo->setRoleId($RoleId);
        $LoadRoleInfo->setSex($Sex);
        $LoadRoleInfo->setIcon($Icon);
        $LoadRoleInfo->setExp($Exp);
        $LoadRoleInfo->setLevel($Level);
        $LoadRoleInfo->setSocialStatus(20000);
        $LoadRoleInfo->setDesc($Desc);
        $UserAttr = new UserAttr();

        $user_attr_ids = $UserAttr->getUserAttrId($uid);

        $LoadRoleInfo->setAvatar($user_attr_ids);//装扮属性
       // var_dump($LoadRoleInfo);

//        $LoadRoleInfo->set
        $str = $LoadRoleInfo->serializeToString();
        return $LoadRoleInfo;
    }
}