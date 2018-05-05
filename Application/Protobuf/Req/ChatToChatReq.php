<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/3
 * Time: 下午9:16
 */

namespace App\Protobuf\Req;

/**
 * 玩家私聊
 * Class ChatToChatReq 1020
 * @package App\Protobuf\Req
 */
class ChatToChatReq
{
    public static function decode($data)
    {
        $ChatToChatReq = new \AutoMsg\ChatToChatReq();
        $ChatToChatReq->mergeFromString($data);
        $RoleId = $ChatToChatReq->getRoleId();
        $Message = $ChatToChatReq->getMessage();
        return ['RoleId'=>$RoleId,'Message'=>$Message];
    }
}