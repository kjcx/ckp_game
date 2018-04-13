<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/9
 * Time: 下午2:38
 */
namespace App\Protobuf\Result;
/**
 * 出售道具返回
 * Class SellItemResult 1069
 * @package App\Protobuf\Result
 */
class SellItemResult
{
    /**
     * @param $uid 用户id
     * @return string
     */
    public static function encode($uid)
    {
        $SellItemResult = new \AutoMsg\SellItemResult();
        $LoadBagInfo = LoadBagInfo::encode($uid);
        $SellItemResult->setBagInfo($LoadBagInfo);
        $SellItemResult->setShenJia(100000);
        $data = $SellItemResult->serializeToString();
        return $data;
    }
}