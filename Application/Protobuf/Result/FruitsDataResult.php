<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/1
 * Time: 下午1:14
 */

namespace App\Protobuf\Result;

/**
 * 返回加载水果机物品
 * Class FruitsDataResult 1030
 * @package App\Protobuf\Result
 */
class FruitsDataResult
{
    public static function encode($data)
    {
        $FruitsDataResult = new \AutoMsg\FruitsDataResult();
        $data = [];
        $LoadFruits = LoadFruits::encode($data);
        $FruitsDataResult->setLoadFruits();
    }
}