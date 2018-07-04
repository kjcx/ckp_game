<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 下午9:45
 */
namespace  App\Protobuf\Result;
use App\Models\User\Role;
use AutoMsg\RoleLists;

class ConnectingResult
{

    public static function encode($uid)
    {

        $ConnectingResult = new \AutoMsg\ConnectingResult();
        $role = $ConnectingResult->getRoleLists();
        $RoleLists = new RoleLists();
        $Role = new Role();
        $role_data = $Role->getRole($uid);
        if($role_data){
            $RoleLists->setRoleId($uid);
        }
        $role[] = $RoleLists;
        $ConnectingResult->setRoleLists($role);
        $data  = $ConnectingResult->serializeToString();
        return $data;
    }
}