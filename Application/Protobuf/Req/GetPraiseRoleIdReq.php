<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/10
 * Time: 下午3:03
 */
namespace App\Protobuf\Req;
/**
 * 显示点赞数
 * Class GetPraiseRoleIdReq 1111
 * @package App\Protobuf\Req
 */
class GetPraiseRoleIdReq
{
    public static function decode($data)
    {
        $GetPraiseRoleIdReq = new \AutoMsg\GetPraiseRoleIdReq();
        $GetPraiseRoleIdReq->mergeFromString($data);
        $RoleId = $GetPraiseRoleIdReq->getRoleId();
        return ['RoleId'=>$RoleId];
    }
}