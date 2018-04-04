<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 下午9:41
 */
namespace App\Protobuf\Req;
class CreateRoleReq
{
    public function __construct($Data)
    {
        $CreateRoleReq = new \AutoMsg\CreateRoleReq();
        $CreateRoleReq->mergeFromString($Data);
        $Name = $CreateRoleReq->getName();
        $Sex = $CreateRoleReq->getSex();
       return ['Name'=>$Name,'Sex'=>$Sex];
    }
}