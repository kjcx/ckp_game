<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/21
 * Time: 下午10:00
 */

namespace App\Protobuf\Result;

/**
 * 获取无主店铺
 * Class NoBodyShopResult 1211
 * @package App\Protobuf\Result
 */
class NoBodyShopResult
{
    public static function encode()
    {
        $NoBodyShopResult = new \AutoMsg\NoBodyShopResult();
//        $NoBodyShopResult->setNoBodyShop();
        $str = $NoBodyShopResult->serializeToString();
        return $str;
    }
}