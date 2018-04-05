<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 下午9:41
 */
namespace App\Protobuf\Req;

/**
 * 创建角色
 * Class CreateRoleReq 1007
 * @package App\Protobuf\Req
 */
class CreateRoleReq
{
    /**
     * 解析数据
     * @param $data
     * @return array
     */
    public static function decode($data)
    {
        $CreateRoleReq = new \AutoMsg\CreateRoleReq();
        $CreateRoleReq->mergeFromString($data);
        $Sex = $CreateRoleReq->getSex();
        $Name = $CreateRoleReq->getName();
        return ['Sex'=>$Sex,'Name'=>$Name];
    }
}