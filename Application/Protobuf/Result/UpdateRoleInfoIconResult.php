<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/16
 * Time: 下午8:08
 */
namespace App\Protobuf\Result;
/**
 * 修改头像
 * Class UpdateRoleInfoIconResult 1141
 * @package App\Protobuf\Result
 */
class UpdateRoleInfoIconResult
{
    public static function encode($RoleIcon)
    {
        $UpdateRoleInfoIconResult = new \AutoMsg\UpdateRoleInfoIconResult();
        $UpdateRoleInfoIconResult->setRoleIcon($RoleIcon);
        $str = $UpdateRoleInfoIconResult->serializeToString();
        return $str;
    }
}