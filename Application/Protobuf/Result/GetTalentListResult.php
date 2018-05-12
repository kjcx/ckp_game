<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/12
 * Time: 下午4:13
 */

namespace App\Protobuf\Result;

/**
 * 人才市场列表返回
 * Class GetTalentListResult 1176
 * @package App\Protobuf\Result
 */
class GetTalentListResult
{
    public static function encode()
    {
        $GetTalentListResult = new \AutoMsg\GetTalentListResult();
        $GetTalentListResult->setInfo();
        $GetTalentListResult->setList();
        $str = $GetTalentListResult->serializeToString();
        return $str;
    }
}