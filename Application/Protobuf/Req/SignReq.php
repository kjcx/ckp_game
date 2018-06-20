<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/19
 * Time: 上午11:35
 */

namespace App\Protobuf\Req;

/**
 * 签到请求
 * Class SignReq
 * @package App\Protobuf\Req
 */
class SignReq
{
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\SignReq();
        $obj->mergeFromString($string);
        return $data;
    }
}