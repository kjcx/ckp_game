<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/17
 * Time: 上午11:57
 */

namespace App\Protobuf\Result;

use App\Models\User\Role;

/**
 * 解雇经理返回
 * Class TalentFireResult 1178
 * @package App\Protobuf\Result
 */
class TalentFireResult
{
    public static function encode($uid)
    {
        $TalentFireResult = new \AutoMsg\TalentFireResult();
        $Role = new Role();
        $data = $Role->getRole($uid);
        $Info = TalentInfo::encode($data);
        $TalentFireResult->setInfo($Info);
        $TalentFireResult->setComplete(true);
        $TalentFireResult->setRoleId($uid);
        $str = $TalentFireResult->serializeToString();
        return $str;
    }
}