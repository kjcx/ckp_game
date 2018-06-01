<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 下午2:07
 */

namespace App\Protobuf\Result;

/**
 * 水果机中奖返回
 * Class RaffleFruitsResult 1035
 * @package App\Protobuf\Result
 */
class RaffleFruitsResult
{
    public static function encode($ItemId)
    {
        $RaffleFruitsResult = new \AutoMsg\RaffleFruitsResult();
        $RaffleFruitsResult->setItemId([$ItemId]);
        $str = $RaffleFruitsResult->serializeToString();
        return $str;
    }
}