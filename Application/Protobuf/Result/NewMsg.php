<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/8
 * Time: 下午1:19
 */

namespace App\Protobuf\Result;

/**
 * 新消息结构体
 * Class NewMsg
 * @package App\Protobuf\Result
 */
class NewMsg
{
    public static function encode($data)
    {
        $arr = [];
        foreach ($data as $datum) {
            $NewMsg = new \AutoMsg\NewMsg();
            $Uid = $datum['uid'];
            $MsgId = $datum['id'];
            $Status = $datum['status'];
            $Content = $datum['content'];
            $Fuid = $datum['fuid'];
            $Time = $datum['time'];
            $Uid = $NewMsg->setUid($Uid);
            $MsgId = $NewMsg->setMsgId($MsgId);
            $Status = $NewMsg->setStatus($Status);
            $Content = $NewMsg->setContent($Content);
            $Fuid = $NewMsg->setFuid($Fuid);
            $Time = $NewMsg->setTime($Time);
            $arr[] = $NewMsg;
        }
        return $arr;
    }
}