<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/7/5
 * Time: 下午3:35
 */

namespace App\Protobuf\Result;

/**
 * 谈判团居民更改返回
 * Class TalkIngGroupResidentChangeResult
 * @package App\Protobuf\Result
 */
class TalkIngGroupResidentChangeResult
{
    public static function encode($data)
    {
        $TalkIngGroupResidentChangeResult = new \AutoMsg\TalkIngGroupResidentChangeResult();
        $TalkIngGroupResidentChangeResult->setDownId($data['DownId']);
        $TalkIngGroupResidentChangeResult->setUpId($data['UpId']);
        $str = $TalkIngGroupResidentChangeResult->serializeToString();
        return $str;
    }
}