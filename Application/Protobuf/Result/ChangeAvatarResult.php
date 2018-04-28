<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/13
 * Time: 上午1:06
 */
namespace App\Protobuf\Result;
use App\Models\User\UserAttr;

class ChangeAvatarResult
{
    public static function encode($uid)
    {

        $ChangeAvatarResult = new \AutoMsg\ChangeAvatarResult();
        $BagInfo = LoadBagInfo::encode($uid);
        $ChangeAvatarResult->setBagInfo($BagInfo);

        $LoadUserAttr = LoadUserAttr::setLoadUserAttr($uid);
        $ChangeAvatarResult->setChangeAttr($LoadUserAttr);
        $str = $ChangeAvatarResult->serializeToString();
        return $str;
    }
}