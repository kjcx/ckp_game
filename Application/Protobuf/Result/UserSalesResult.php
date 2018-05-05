<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/4
 * Time: 上午11:08
 */

namespace App\Protobuf\Result;

/**
 * 用户寄卖返回
 * Class UserSalesResult 1080
 * @package App\Protobuf\Result
 */
class UserSalesResult
{
    public static function encode($data)
    {
        $UserSalesResult = new \AutoMsg\UserSalesResult();
        $UserSalesResult->setGoods();
        $str = $UserSalesResult->serializeToString();
        return $str;
    }
}