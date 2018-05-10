<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/25
 * Time: 下午3:31
 */

namespace App\Protobuf\Result;


use App\Models\Company\Company;

class CreateCompanyResult
{
    public static function encode($uid)
    {
        $CreateCompanyResult = new \AutoMsg\CreateCompanyResult();
        $Company = new Company();
        $data = $Company->getCompany($uid);
        $CompanyInfo = LoadCompanyInfo::encode($data);
        $CreateCompanyResult->setCompanyInfo($CompanyInfo);
//        $CreateCompanyResult->setDepartmentInfo();
        $str = $CreateCompanyResult->serializeToString();
        return $str;
    }
}