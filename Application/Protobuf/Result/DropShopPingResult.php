<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午12:54
 */
namespace App\Protobuf\Result;
/**
 * 掉落库的商品购买
 * Class DropShopPingResult 1107
 * @package App\Protobuf\Result
 */
class DropShopPingResult
{
    public static function encode()
    {
        $DropShopPingResult = new \AutoMsg\DropShopPingResult();
        $DropShopPingResult->setLoadConsume();
    }
}