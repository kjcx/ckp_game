<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/17
 * Time: 上午11:34
 */

namespace App\Protobuf\Req;

/**
 * 解雇经理
 * Class TalentFireReq 1132
 * @package App\Protobuf\Req
 */
class TalentFireReq
{
    public static function decode($data)
    {
        $TalentFireReq = new \AutoMsg\TalentFireReq();
        $TalentFireReq->mergeFromString($data);
        $RoleId = $TalentFireReq->getRoleId();
        return ['RoleId'=>$RoleId];
    }
}