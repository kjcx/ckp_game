<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/7/5
 * Time: 下午5:14
 */

namespace App\Protobuf\Result;

/**
 * 店铺收获返回
 * Class HarvestPublicShopResult
 * @package App\Protobuf\Result
 */
class HarvestPublicShopResult
{
    public static function encode($data)
    {
        $HarvestPublicShopResult = new \AutoMsg\HarvestPublicShopResult();
        $LoadConsume = [];
        foreach ($data as $item) {
            var_dump("item");
            var_dump($item);
            $LoadConsume[] = LoadConsumeData::encode($item);
        }
        $HarvestPublicShopResult->setLoadConsume($LoadConsume);
        $str = $HarvestPublicShopResult->serializeToString();
        return $str;
    }
}