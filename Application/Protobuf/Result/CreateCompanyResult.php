<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/25
 * Time: 下午3:31
 */

namespace App\Protobuf\Result;


class CreateCompanyResult
{
    public static function encode()
    {
        $CreateCompanyResult = new \AutoMsg\CreateCompanyResult();
        $CreateCompanyResult->setCompanyInfo();
        $CreateCompanyResult->setDepartmentInfo();
        $str = $CreateCompanyResult->serializeToString();
        return $str;
    }
}