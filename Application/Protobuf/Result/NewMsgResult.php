<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/8
 * Time: 下午1:12
 */

namespace App\Protobuf\Result;

/**
 * 返回新消息
 * Class NewMsgResult
 * @package App\Protobuf\Result
 */
class NewMsgResult
{
    public static function encode($data)
    {
        $NewMsgResult = new \AutoMsg\NewMsgResult();

        $arr = NewMsg::encode($data);
        $NewMsgResult->setNewMsgList($arr);
        $str = $NewMsgResult->serializeToString();
        return $str;

    }
}