<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/26
 * Time: 下午4:06
 */

namespace App\Protobuf\Req;

/**
 * 解锁npc
 * Class UnlockNpcReq
 * @package App\Protobuf\Req
 */
class UnlockNpcReq
{
    public static function decode($data)
    {
        $UnlockNpcReq = new \AutoMsg\UnlockNpcReq();
        $UnlockNpcReq->mergeFromString($data);
        $NpcId = $UnlockNpcReq->getNpcId();
        return ['NpcId'=>$NpcId];
    }
}