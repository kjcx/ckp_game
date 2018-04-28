<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/10
 * Time: 下午3:06
 */
namespace App\Protobuf\Result;
use App\Models\User\UserAttr;

/**
 * 加载用户属性
 * Class LoadUserAttr
 * @package App\Protobuf\Result
 */
class LoadUserAttr
{
    public static function encode($id)
    {

        $LoadUserAttr = new \AutoMsg\LoadUserAttr();
        $LoadUserAttr->setUserAttrID($id);
        return $LoadUserAttr;
    }

    /**
     * 设置用户属性
     * @param $uid
     * @return array
     */
    public static function setLoadUserAttr($uid)
    {
        $UserAttr = new UserAttr();
        $user_attr_ids = $UserAttr->getUserAttrId($uid);
        $arr = [];
        foreach ($user_attr_ids as $v) {
            $arr[] = LoadUserAttr::encode($v);
        }
        return $arr;

    }

}