<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/7
 * Time: 下午6:12
 */

namespace App\Protobuf\Req;

/**
 * 交易行请求
 * Class SalesListReq
 * @package App\Protobuf\Req
 */
class SalesListReq
{
    public static function decode()
    {
        $SalesListReq = new \AutoMsg\SalesListReq();
    }
}