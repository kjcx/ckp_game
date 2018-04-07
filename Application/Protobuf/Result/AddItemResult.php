<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午12:51
 */
namespace App\Protobuf\Result;
/**
 *  添加道具进背包返回
 * Class AddItemResult 1053
 * @package App\Protobuf\Result
 */
class AddItemResult
{
    public static function encode($uid)
    {
        $AddItemResult = new \AutoMsg\AddItemResult();
        $AddItemResult->setShenJia(10000);
        $LoadBagInfo = LoadBagInfo::encode($uid);
        $AddItemResult->setBagInfo($LoadBagInfo);
//        $AddItemResult->setChangeAttr();
        $str = $AddItemResult->serializeToString();
        return $str;
    }
}