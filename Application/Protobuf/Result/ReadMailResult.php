<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/8
 * Time: 下午12:06
 */

namespace App\Protobuf\Result;

/**
 * 阅读邮件返回
 * Class ReadMailResult
 * @package App\Protobuf\Result
 */
class ReadMailResult
{
    public static function encode($Id)
    {
        $ReadMailResult = new \AutoMsg\ReadMailResult();
        $ReadMailResult->setId($Id);
        $str = $ReadMailResult->serializeToString();
        return $str;
    }
}