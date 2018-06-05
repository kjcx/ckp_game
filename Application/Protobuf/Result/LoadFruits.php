<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/1
 * Time: 下午1:15
 */

namespace App\Protobuf\Result;


use AutoMsg\LoadFruitsData;

/**
 * 返回水果机数据
 * Class LoadFruits
 * @package App\Protobuf\Result
 */
class LoadFruits
{
    public static function encode($data)
    {
        $LoadFruitsData = new LoadFruitsData();
        $Count = $data['Count'];
        $FruitsId = $data['FruitsId'];
        $ItemId = $data['ItemId'];
        $Status = $data['Status'];
        $LoadFruitsData->setCount($Count);
        $LoadFruitsData->setFruitsId($FruitsId);
        $LoadFruitsData->setItemId($ItemId);
        $LoadFruitsData->setStatus($Status);
        return $LoadFruitsData;
    }
}