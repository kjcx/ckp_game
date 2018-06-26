<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/26
 * Time: 下午4:08
 */

namespace App\Protobuf\Result;

/**
 * 解锁npc返回
 * Class UnlockNpcResult
 * @package App\Protobuf\Result
 */
class UnlockNpcResult
{
    public static function encode($NpcId)
    {
        $UnlockNpcResult = new \AutoMsg\UnlockNpcResult();
        $UnlockNpcResult->setNpcId($NpcId);
        $str = $UnlockNpcResult->serializeToString();
        return $str;
    }
}