<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/24
 * Time: 上午11:30
 */

namespace App\Protobuf\Result;

/**
 * 向频道发送信息
 * Class SendMsgToChannelResult 1006
 * @package App\Protobuf\Result
 */
class SendMsgToChannelResult
{
    public static function encode()
    {
        $SendMsgToChannelResult = new \AutoMsg\SendMsgToChannelResult();
        $SendMsgToChannelResult->setStatus();
    }
}