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
    public static function encode($ItmeList)
    {
        $ItmeList = new \AutoMsg\ItemList();
        $ItmeList->setItemList($ItmeList);
        return $ItmeList;
    }
}