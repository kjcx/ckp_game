<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 下午1:26
 */
namespace App\Protobuf\Result;
use App\Models\BagInfo\Bag;
use App\Models\User\RoleBag;

class LoadBagInfo
{
    public static function encode($uid)
    {
        //查询背包信息
        $RoleBag = new RoleBag();
        $data = $RoleBag->getRoleBag($uid);
        $Bag = new Bag($uid);
        $data = $Bag->getBag();
        var_dump($data);
        $LoadBagInfo = new \AutoMsg\LoadBagInfo();
        $LoadBagInfo->setMaxCellNumber((int)$data['MaxCellNumber']);
        $LoadBagInfo->setCurUsedCell((int)$data['CurUsedCell']);
        $LoadBagInfo->setFurnitrues($LoadBagInfo->getFurnitrues());
        $items = LoadRoleBagInfo::encode($data['data']);
        $LoadBagInfo->setItems($items);
        return $LoadBagInfo;
    }
}