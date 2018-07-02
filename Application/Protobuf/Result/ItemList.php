<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/26
 * Time: 下午7:35
 */

namespace App\Protobuf\Result;

/**
 * 道具列表
 * Class ItemList
 * @package App\Protobuf\Result
 */
class ItemList
{
    public static function encode($data)
    {
        $ItemList = new \AutoMsg\ItemList();
        $ItemList->setItem($data);
        return $ItemList;
    }
}