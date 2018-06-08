<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/7
 * Time: 下午6:13
 */

namespace App\Protobuf\Result;

/**
 * 交易行列表
 * Class SalesListResult
 * @package App\Protobuf\Result
 */
class SalesListResult
{
    public static function encode($data)
    {
        $SalesListResult = new \AutoMsg\SalesListResult();
        $data = [];
        foreach ($data as $datum) {
            $goods[] = DealGoodsUpdate::encode($data);
        }

        $SalesListResult->setGoods($goods);
        $str = $SalesListResult->serializeToString();
        return $str;
    }
}