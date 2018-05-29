<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/26
 * Time: 下午1:48
 */

namespace App\Protobuf\Result;

/**
 * 已获得土地列表
 * Class MyLandInfoList
 * @package App\Protobuf\Result
 */
class MyLandInfoList
{
    public static function encode($data)
    {
        $MyLandInfoList = new \AutoMsg\MyLandInfoList();
        $Pos = $data['Pos'];//土地id
        $Gold = $data['Gold'];//金币
        $CreateTime = $data['CreateTime'];//获得时间
        $MyLandInfoList->setPos($Pos);
        $MyLandInfoList->setGold($Gold);
        $MyLandInfoList->setCreateTime($CreateTime);
        return $MyLandInfoList;
    }
}