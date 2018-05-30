<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/16
 * Time: 下午7:54
 */
namespace App\Protobuf\Req;
/**
 * 更改头像
 * Class UpdateRoleInfoIconReq 1102
 * @package App\Protobuf\Req
 */
class UpdateRoleInfoIconReq
{
    public static function decode($data)
    {
        $UpdateRoleInfoIconReq = new \AutoMsg\UpdateRoleInfoIconReq();
        $UpdateRoleInfoIconReq->mergeFromString($data);
        $RoleIcon = $UpdateRoleInfoIconReq->getRoleIcon();
//        var_dump($RoleIcon);
        return ['RoleIcon'=>$RoleIcon];
    }
}