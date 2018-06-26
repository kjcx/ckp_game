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
 * Class ItmeList
 * @package App\Protobuf\Result
 */
class ItmeList
{
    public static function encode($ItmeList)
    {
        $ItmeList = new \AutoMsg\ItmeList();
        $ItmeList->setItmeList($ItmeList);
        return $ItmeList;
    }
}