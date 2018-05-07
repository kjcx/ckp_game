<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/26
 * Time: 下午7:04
 */

namespace App\Protobuf\Result;

/**
 * 返回信息
 * Class GetPraiseRoleIdResult
 * @package App\Protobuf\Result
 */
class GetPraiseRoleIdResult
{
    public static function encode($uid)
    {
        $GetPraiseRoleIdResult = new \AutoMsg\GetPraiseRoleIdResult();
        $LoadRoleInfo = LoadRoleInfo::encode($uid);
        $GetPraiseRoleIdResult->setLoadRoleInfos($LoadRoleInfo);

        $str = $GetPraiseRoleIdResult->serializeToString();
        return $str;
    }
}