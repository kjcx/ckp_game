<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/14
 * Time: 下午5:00
 */

namespace App\Protobuf\Req;

/**
 * 刷新人才市场
 * Class TalentRefreshReq
 * @package App\Protobuf\Req
 */
class TalentRefreshReq
{
    public static function decode($data)
    {
        $TalentRefreshReq = new \AutoMsg\TalentRefreshReq();
    }
}