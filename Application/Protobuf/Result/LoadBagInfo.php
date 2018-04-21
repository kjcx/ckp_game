<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 下午1:26
 */
namespace App\Protobuf\Result;
use App\Models\User\RoleBag;

class LoadBagInfo
{
    public static function encode($uid)
    {
        //查询背包信息
        $RoleBag = new RoleBag();
        $data = $RoleBag->getRoleBag($uid);
        //items
        $items = $data['items'];
        $items_data = json_decode($items,1);
        var_dump($items_data);
        $LoadBagInfo = new \AutoMsg\LoadBagInfo();
        $LoadBagInfo->setMaxCellNumber($data['maxsum']);
        $LoadBagInfo->setCurUsedCell($data['usesum']);
        $LoadBagInfo->setFurnitrues($LoadBagInfo->getFurnitrues());
        $items = LoadRoleBagInfo::encode($items_data);
        $LoadBagInfo->setItems($items);
        return $LoadBagInfo;
    }
}