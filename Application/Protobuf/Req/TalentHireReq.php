<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/14
 * Time: 下午4:42
 */

namespace App\Protobuf\Req;

/**
 * 人才市场雇佣请求
 * Class TalentHireReq
 * @package App\Protobuf\Req
 */
class TalentHireReq
{
    public static function decode($data)
    {
        $TalentHireReq = new \AutoMsg\TalentHireReq();
        $TalentHireReq->mergeFromString($data);
        $RoleId = $TalentHireReq->getRoleId();
        $ShopId = $TalentHireReq->getShopId();
        return ['Uid'=>$RoleId,'ShopId'=>$ShopId];
    }
}