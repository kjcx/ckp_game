<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/27
 * Time: 下午8:20
 */

namespace App\Protobuf\Req;

/**
 * 提升居民品质
 * Class NpcRelationAdvanceReq
 * @package App\Protobuf\Req
 */
class NpcRelationAdvanceReq
{
    public static function decode($data)
    {
        $NpcRelationAdvanceReq = new \AutoMsg\NpcRelationAdvanceReq();
        $NpcRelationAdvanceReq->mergeFromString($data);
        $NpcId = $NpcRelationAdvanceReq->getNpcId();
        return ['NpcId'=>$NpcId];
    }
}