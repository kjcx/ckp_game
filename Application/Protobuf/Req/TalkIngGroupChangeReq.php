<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/28
 * Time: 下午5:25
 */

namespace App\Protobuf\Req;

/**
 * 谈判团换任
 * Class TalkIngGroupChangeReq
 * @package App\Protobuf\Req
 */
class TalkIngGroupChangeReq
{
    public static function decode($data)
    {
        $TalkIngGroupChangeReq = new \AutoMsg\TalkIngGroupChangeReq();
        $TalkIngGroupChangeReq->mergeFromString($data);
        $UpId = $TalkIngGroupChangeReq->getUpId();
        $DownId = $TalkIngGroupChangeReq->getDownId();
        return ['UpId'=>$UpId,'DownId'=>$DownId];
    }
}