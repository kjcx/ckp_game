<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/6
 * Time: 上午12:26
 */
namespace App\Protobuf\Result;
use App\Models\User\RoleBag;

class LoadRoleBagInfo
{
    public static function encode($items_data)
    {
        $arr =[];
        foreach ($items_data as $k=>$v) {
            $LoadRoleBagInfo = new \AutoMsg\LoadRoleBagInfo();
            $LoadRoleBagInfo->setId((int)$v['id']);//
            $LoadRoleBagInfo->setCurCount((int)$v['CurCount']);//当前叠加数量
            $LoadRoleBagInfo->setFurnitureId(0);//家具id
            $LoadRoleBagInfo->setOnSpace((int)$v['OnSpace']);//占用空间 当道具数量超出999时  占用空间+1
            $LoadRoleBagInfo->setStar(0);//家居星级
            $arr[$k] = $LoadRoleBagInfo;
        }
        return $arr;
    }
}