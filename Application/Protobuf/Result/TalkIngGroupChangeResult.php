<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/28
 * Time: 下午6:30
 */

namespace App\Protobuf\Result;

/**
 * 谈判团换任返回
 * Class TalkIngGroupChangeResult
 * @package App\Protobuf\Result
 */
class TalkIngGroupChangeResult
{
    public static function ecode($data)
    {
        $TalkIngGroupChangeResult = new \AutoMsg\TalkIngGroupChangeResult();
        $DownId = $TalkIngGroupChangeResult->setDownId($data['DownId']);
        $UpId = $TalkIngGroupChangeResult->setUpId($data['UpId']);
        return ['UpId'=>$UpId,'DownId'=>$DownId];
    }
}