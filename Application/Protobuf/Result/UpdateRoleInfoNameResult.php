<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/21
 * Time: 下午4:11
 */

namespace App\Protobuf\Result;

/**
 * 修改昵称返回
 * Class UpdateRoleInfoNameResult 1142
 * @package App\Protobuf\Result
 */
class UpdateRoleInfoNameResult
{
    public static function encode($RoleName)
    {
        $UpdateRoleInfoNameResult = new \AutoMsg\UpdateRoleInfoNameResult();
        $UpdateRoleInfoNameResult->setRoleName($RoleName);
        $str = $UpdateRoleInfoNameResult->serializeToString();
        return $str;
    }
}