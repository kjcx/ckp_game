<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/8
 * Time: 下午12:00
 */

namespace App\Protobuf\Result;

/**
 * 请求邮件返回
 * Class MailResult
 * @package App\Protobuf\Result
 */
class MailResult
{
    public static function encode($data)
    {
        $MailResult = new \AutoMsg\MailResult();
        $Mails = [];
        foreach ($data as $item) {
            $Mails[] = MailMsg::encode($item);
        }
//        $MailResult->setMail($Mails);
//        $str = $MailResult->serializeToString();
        return $Mails;
    }
}