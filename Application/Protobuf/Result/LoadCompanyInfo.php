<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/25
 * Time: 下午4:16
 */

namespace App\Protobuf\Result;

/**
 * 公司信息
 * Class LoadCompanyInfo
 * @package App\Protobuf\Result
 */
class LoadCompanyInfo
{
    public static function encode($data)
    {
        $LoadCompanyInfo = new \AutoMsg\LoadCompanyInfo();
        $Id = $data['Id'];
        $Name = $data['Name'];
        $SocialStatus = $data['SocialStatus'];
        $CreateTime = time();//时间戳
        $LoadCompanyInfo->setId();//公司id
        $LoadCompanyInfo->setName($Name);//公司名称
        $LoadCompanyInfo->setSocialStatus($SocialStatus);//公司身价
        $LoadCompanyInfo->setCreateTime($CreateTime);//创建时间
        return $LoadCompanyInfo;
    }
}