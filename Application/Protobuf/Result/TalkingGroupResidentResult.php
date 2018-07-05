<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/7/5
 * Time: 下午3:14
 */

namespace App\Protobuf\Result;

/**
 * 谈判团任命返回
 * Class TalkingGroupResidentResult
 * @package App\Protobuf\Result
 */
class TalkingGroupResidentResult
{
    public static function encode($data)
    {
        $TalkingGroupResidentResult = new \AutoMsg\TalkingGroupResidentResult();
        $TalkingGroupResidentResult->setIds($data['Ids']);
        $TalkingGroupResidentResult->setDownId($data['DownId']);
        $str = $TalkingGroupResidentResult->serializeToString();
        return $str;
    }
}