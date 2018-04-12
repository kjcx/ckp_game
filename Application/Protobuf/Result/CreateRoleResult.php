<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 下午9:37
 */
namespace App\Protobuf\Result;
class CreateRoleResult
{

    public static function encode($data)
    {
        $Sex = $data['Sex'];
        $RoleId = $data['RoleId'];
        $Name = $data['Name'];
        $CreateRoleResult = new \AutoMsg\CreateRoleResult();
        $CreateRoleResult->setSex($Sex);
        $CreateRoleResult->setRoleId($RoleId);
        $CreateRoleResult->setName($Name);
        $str = $CreateRoleResult->serializeToString();
        return $str;
    }
}