<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 下午9:34
 */
namespace App\Protobuf\Result;

/**
 * 服务端头信息
 * Class MsgBaseSend
 * @package App\Protobuf\Result
 */
class MsgBaseSend
{
    /**
     * 加密服务端消息头
     * @param $MsgID
     * @param $Data
     * @param int $Result
     * @param string $ErrorMsg
     * @return string
     */
    public static function encode($MsgID,$Data,$Result=0,$ErrorMsg='')
    {
        $MsgBaseSend = new \AutoMsg\MsgBaseSend();
        $MsgBaseSend->setMsgID($MsgID);
        $MsgBaseSend->setData($Data);
        $MsgBaseSend->setResult($Result);
//        $MsgBaseSend->setErrorMsg($ErrorMsg);
        $str = $MsgBaseSend->serializeToString();
        return $str;
    }
}
