<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/1
 * Time: 下午1:14
 */

namespace App\Protobuf\Result;
use App\Models\FruitsData\FruitsData;

/**
 * 返回加载水果机物品
 * Class FruitsDataResult 1030
 * @package App\Protobuf\Result
 */
class FruitsDataResult
{
    public static function encode($uid)
    {
        $FruitsDataResult = new \AutoMsg\FruitsDataResult();
        $data = [];
        $FruitsData = new FruitsData();
        $arr = $FruitsData->getFruitsData(['Uid'=>$uid]);
        var_dump($arr);
        $LoadFruits = [];
        foreach ($arr as $k =>$item) {
//            $LoadFruits[$k] = LoadFruits::encode($item);
            $LoadFruits[$k] = LoadFruits::encode($item);
        }
        $FruitsDataResult->setLoadFruits($LoadFruits);
        $str = $FruitsDataResult->serializeToString();
        return $str;
    }
}