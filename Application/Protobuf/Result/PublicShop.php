<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/24
 * Time: 下午3:07
 */

namespace App\Protobuf\Result;


class PublicShop
{
    public static function ecode($data)
    {
        $PublicShop = new \AutoMsg\PublicShop();
        $RoleId = $data['RoleId'];
        $Name = $data['Name'];//名字
        $BuildId = $data['BuildId'];//店铺id
        $BuildType = $data['BuildType'];//店铺类型
        $CurExtendLv = $data['CurExtendLv'];//扩展等级
        $CurrSellPrice = $data['CurrSellPrice'];//当前竞拍价格
        $Pos = $data['Pos'];
        $ShopLevel = $data['ShopLevel'];//
        $StartCurrSellPrice = $data['StartCurrSellPrice'];//竞拍起始价格
        $PublicShop->setRoleId();
        $PublicShop->setName();
        $PublicShop->setBuildId();
        $PublicShop->setBuildType();
        $PublicShop->setCurExtendLv();
        $PublicShop->setCurrSellPrice();
        $PublicShop->setPos();
        $PublicShop->setShopLevel();
        $PublicShop->setStartCurrSellPrice();
        return $PublicShop;
    }
}