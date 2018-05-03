<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/25
 * Time: 下午9:04
 */

namespace App\Protobuf\Result;

use App\Models\BagInfo\Bag;
use App\Models\User\Role;

/**
 * 使用道具返回
 * Class UseItemResult 1078
 * @package App\Protobuf\Result
 */
class UseItemResult
{
    public static function encode($uid,$item_count)
    {
        $UseItemResult = new \AutoMsg\UseItemResult();
        $BagInfo = LoadBagInfo::encode($uid);
        $UseItemResult->setBagInfo($BagInfo);//设置背包
        $ChangeAttr = LoadUserAttr::setLoadUserAttr($uid);//用户属性
        $UseItemResult->setChangeAttr($ChangeAttr);//用户属性
        $Role = new Role();
        $data_role = $Role->getRole($uid);
        $UseItemResult->setExp($data_role['exp']);//
//        $UseItemResult->setItemCount();//使用道具数量（？）
        $UseItemResult->setShenjia($data_role['shenjiazhi']);
        $UseItemResult->setLevel($data_role['level']);
        $UseItemResult->setItemCount($item_count);
        $str = $UseItemResult->serializeToString();
        return $str;
    }
}