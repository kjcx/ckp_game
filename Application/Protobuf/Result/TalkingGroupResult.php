<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/28
 * Time: 下午8:23
 */

namespace App\Protobuf\Result;

/**
 * 谈判团任命返回
 * Class TalkingGroupResult
 * @package App\Protobuf\Result
 */
class TalkingGroupResult
{
    public static function encode($data)
    {
        $TalkingGroupResult = new \AutoMsg\TalkingGroupResult();
        $TalkingGroupResult->setDownId($data['DownId']);
        $TalkingGroupResult->setIds($data['Ids']);
        $str = $TalkingGroupResult->serializeToString();
        return $str;
    }
}