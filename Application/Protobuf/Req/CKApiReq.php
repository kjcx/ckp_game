<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/19
 * Time: 下午12:10
 */
namespace App\Protobuf\Req;
/**
 * 创客api接口请求
 * Class CKApiReq 1165
 * @package App\Protobuf\Req
 */
class CKApiReq
{
    public static function decode($data)
    {
        $CKApiReq = new \AutoMsg\CKApiReq();
        $CKApiReq->mergeFromString($data);
        $Key = $CKApiReq->getKey();
        $Type = $CKApiReq->getType();
        $RmbParams = $CKApiReq->getGetRmbParams();
        $PayLogParams = $CKApiReq->getPayLogParams();
        $TeamParams = $CKApiReq->getTeamParams();
        $PayParams_id = $CKApiReq->getPayParams()->getId();//id
        $PayParams_pwd = $CKApiReq->getPayParams()->getPwd();//密码
        return [
            'Key'=>$Key,'Type'=>$Type,'RmbParams'=>$RmbParams,
            'PayLogParams'=>$PayLogParams,'TeamParams'=>$TeamParams,
            'PayParams'=>['Id'=>$PayParams_id,'Pwd'=>$PayParams_pwd]];
    }
}