<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/8
 * Time: 上午11:55
 */

namespace App\Protobuf\Result;

/**
 * 批量删除邮件返回
 * Class DelMailsResult
 * @package App\Protobuf\Result
 */
class DelMailsResult
{
    public static function encode($ids)
    {
        $DelMailsResult = new \AutoMsg\DelMailsResult();
        $DelMailsResult->setId($ids);
        $str = $DelMailsResult->serializeToString();
        return $str;
    }
}