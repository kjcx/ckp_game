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
        $str = $AddNpcRelationAdvanceReq->getAddNpcFavor();
        $AddNpcFavorability = new AddNpcFavorability();
        $AddNpcFavorability->mergeFromString($str);
        $NpcId = $AddNpcFavorability->getNpcId();
        $ItemcCount = $AddNpcFavorability->getItemCount();
        $ItemId = $AddNpcFavorability->getItemId();
        return ['NpcId'=>$NpcId,'ItemId'=>$ItemId,'ItemCount'=>$ItemcCount];
    }
}   