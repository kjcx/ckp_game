<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/25
 * Time: 下午2:25
 */

namespace App\Protobuf\Req;

/**
 * 创建公司
 * Class CreateCompanyReq 1006
 * @package App\Protobuf\Req
 */
class CreateCompanyReq
{
    public static function decode($data)
    {
        $CreateCompanyReq = new \AutoMsg\CreateCompanyReq();
        $CreateCompanyReq->mergeFromString($data);
        $Name = $CreateCompanyReq->getName();
        return ['Name'=>$Name];
    }
}