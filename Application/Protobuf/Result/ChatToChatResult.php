<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/3
 * Time: 下午9:33
 */

namespace App\Protobuf\Result;

/**
 * 私聊返回
 * $MsgId 1009
 * Class ChatToChatResult 1009
 * @package App\Protobuf\Result
 */
class ChatToChatResult
{
    public static function encode()
    {
        $ChatToChatResult = new \AutoMsg\ChatToChatResult();
        $ChatToChatResult->setStatus(1);
        $str = $ChatToChatResult->serializeToString();
        return $str;
    }
}