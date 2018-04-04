<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/4
 * Time: 下午9:29
 */
namespace App\Models\Protobuf;

class MsgBaseSend
{
    public function __construct($MsgID,$Data,$Result=0){
        $MsgBaseSend = new \AutoMsg\MsgBaseSend();
        $MsgBaseSend->setMsgID($MsgID);
        $MsgBaseSend->setData($Data);
        return $MsgBaseSend->serializeToString();
    }
}
