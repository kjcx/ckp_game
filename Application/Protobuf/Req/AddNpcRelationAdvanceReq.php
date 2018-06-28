<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/27
 * Time: 下午1:47
 */

namespace App\Protobuf\Req;


use AutoMsg\AddNpcFavorability;

/**
 * 增加好感度
 * Class AddNpcRelationAdvanceReq
 * @package App\Protobuf\Req
 */
class AddNpcRelationAdvanceReq
{
    public static function decode($data)
    {

        $AddNpcRelationAdvanceReq = new \AutoMsg\AddNpcRelationAdvanceReq();
        $AddNpcRelationAdvanceReq->mergeFromString($data);
        $NpcId = $AddNpcRelationAdvanceReq->getAddNpcFavor()->getNpcId();
        $ItemId = $AddNpcRelationAdvanceReq->getAddNpcFavor()->getItemId();
        $ItemCount = $AddNpcRelationAdvanceReq->getAddNpcFavor()->getItemCount();
        return ['NpcId'=>$NpcId,'ItemId'=>$ItemId,'ItemCount'=>$ItemCount];
    }
}   