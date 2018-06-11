<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/8
 * Time: 上午11:58
 */

namespace App\Protobuf\Result;

/**
 * 获取邮件中的物品返回
 * Class GetMailItemsResult
 * @package App\Protobuf\Result
 */
class GetMailItemsResult
{
    public static function encode($Ids)
    {
        $GetMailItemsResult = new \AutoMsg\GetMailItemsResult();
        $GetMailItemsResult->setId($Ids);
        $str = $GetMailItemsResult->serializeToString();
        return $str;
    }
}