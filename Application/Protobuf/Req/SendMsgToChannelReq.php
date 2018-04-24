<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/24
 * Time: 上午10:59
 */

namespace App\Protobuf\Req;

/**
 * 发送消息
 * Class SendMsgToChannelReq 1019
 * @package App\Protobuf\Req
 */
class SendMsgToChannelReq
{
    public static function decode($data)
    {
        $SendMsgToChannelReq = new \AutoMsg\SendMsgToChannelReq();
        $SendMsgToChannelReq->mergeFromString($data);
        $Msg = $SendMsgToChannelReq->getMsg();//消息
        $ChannelId = $SendMsgToChannelReq->getChannelId();//频道
        return ['ChannelId'=>$ChannelId,'Msg'=>$Msg];
    }
}