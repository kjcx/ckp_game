<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/13
 * Time: 下午7:15
 */

namespace App\Protobuf\Result;

/**
 * 解雇员工返回
 * Class DismissalEmployeeResult
 * @package App\Protobuf\Result
 */
class DismissalEmployeeResult
{
    public static function encode($ListId)
    {
        $DismissalEmployeeResult = new \AutoMsg\DismissalEmployeeResult();
        $DismissalEmployeeResult->setListId($ListId);
        $str = $DismissalEmployeeResult->serializeToString();
        return $str;
    }
}