<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 下午12:17
 */
namespace App\Protobuf\Result;
/**
 * 解析客户端发过来的消息头
 * Class MsgBaseRev
 * @package App\Protobuf\Result
 */
class MsgBaseRev
{
    /**
     * 解析数据
     * @param $data
     * @return array
     */
    public static function decode($data)
    {
        $MsgBaseRev = new \AutoMsg\MsgBaseRev();
        $MsgBaseRev->mergeFromString($data);
        $MsgId = $MsgBaseRev->getMsgId();
        $Data = $MsgBaseRev->getData();
        $PartitionKey = $MsgBaseRev->getPartitionKey();
        $SignKey = $MsgBaseRev->getSignKey();
        return ['MsgId'=>$MsgId,'Data'=>$Data,'PartitionKey'=>$PartitionKey,'SignKey'=>$SignKey];
    }
}