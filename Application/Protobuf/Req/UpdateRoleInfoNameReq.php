<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/20
 * Time: 下午4:14
 */

namespace App\Protobuf\Req;

/**
 * 修改角色姓名
 * Class UpdateRoleInfoNameReq
 * @package App\Protobuf\Req
 */
class UpdateRoleInfoNameReq
{
    public static function decode($data)
    {
        $UpdateRoleInfoNameReq  = new \AutoMsg\UpdateRoleInfoNameReq();
        $UpdateRoleInfoNameReq->mergeFromString($data);
        $RoleName = $UpdateRoleInfoNameReq->getRoleName();
        return ['RoleName'=>$RoleName];
    }
}