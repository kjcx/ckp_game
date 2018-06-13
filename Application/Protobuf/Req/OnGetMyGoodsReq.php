<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/11
 * Time: 下午6:32
 */

namespace App\Protobuf\Req;

/**
 * 交易行自己商品
 * Class OnGetMyGoodsReq
 * @package App\Protobuf\Req'
 */
class OnGetMyGoodsReq
{
    public static function decode()
    {
        $OnGetMyGoodsReq = new \AutoMsg\OnGetMyGoodsReq();

    }
}