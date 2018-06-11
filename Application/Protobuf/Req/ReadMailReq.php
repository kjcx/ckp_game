<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/8
 * Time: 下午12:04
 */

namespace App\Protobuf\Req;

/**
 * 阅读邮件请求
 * Class ReadMailReq
 * @package App\Protobuf\Req
 */
class ReadMailReq
{
    public static function decode($data)
    {
        $ReadMailReq = new \AutoMsg\ReadMailReq();
        $ReadMailReq->mergeFromString($data);
        $Id = $ReadMailReq->getId();
        return ['Id'=>$Id];
    }
}