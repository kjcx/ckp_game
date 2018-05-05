<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/4
 * Time: 上午11:39
 */

namespace App\Protobuf\Result;


class MailMsg
{
    public static function encode($uid)
    {
        $arr = [];
        $data = [];
        foreach ($data as $item) {
            $Id = $item['Id'];
            $Msg = $item['Msg'];
            $Item = $item['Item'];
            $Read = $item['Read'];
            $Reward = $item['Reward'];
            $SenderIcon = $item['SenderIcon'];
            $SenderName = $item['SenderName'];
            $SendTime = $item['SendTime'];
            $Title = $item['Title'];
            $SenderId = $item['SenderId'];
            $MailMsg = new \AutoMsg\MailMsg();
            $MailMsg->setId($Id);//邮件id
            $MailMsg->setItem($Item);//道具
            $MailMsg->setMsg($Msg);//消息
            $MailMsg->setRead($Read);//是否已读
            $MailMsg->setReward($Reward);//奖励是否已经领取
            $MailMsg->setSenderIcon($SenderIcon);//头像
            $MailMsg->setSenderName($SenderName);//发送人名字
            $MailMsg->setSendTime($SendTime);//发送时间
            $MailMsg->setTitle($Title);//邮件标题
            $MailMsg->setSenderId(SenderId);//发件人id
            $arr[] = $MailMsg;
        }

        return $arr;
    }

}