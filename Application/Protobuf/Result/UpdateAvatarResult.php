<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/13
 * Time: 下午5:20
 */
namespace App\Protobuf\Result;
/**
 * 更改装扮属性
 * Class UpdateAvatarResult 1074
 * @package App\Protobuf\Result
 */
class UpdateAvatarResult
{
    public static function encode($ids)
    {
        $UpdateAvatarResult = new \AutoMsg\UpdateAvatarResult();
        $UpdateAvatarResult->setId($ids);
        $str = $UpdateAvatarResult->serializeToString();
        return $str;
    }
}