<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/12
 * Time: 下午4:12
 */

namespace App\Protobuf\Req;

/**
 * 人才市场列表
 * Class GetTalentListReq
 * @package App\Protobuf\Req
 */
class GetTalentListReq
{
    public static function decode()
    {
        $GetTalentListReq = new \AutoMsg\GetTalentListReq();
    }
}