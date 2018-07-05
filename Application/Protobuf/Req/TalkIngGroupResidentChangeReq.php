<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/7/5
 * Time: 下午3:33
 */

namespace App\Protobuf\Req;

/**
 * 谈判团居民任职更改
 * Class TalkIngGroupResidentChangeReq
 * @package App\Protobuf\Req
 */
class TalkIngGroupResidentChangeReq
{
    public static function decode($data)
    {
        $TalkIngGroupResidentChangeReq = new \AutoMsg\TalkIngGroupResidentChangeReq();
        $TalkIngGroupResidentChangeReq->mergeFromString($data);
        $DownId = $TalkIngGroupResidentChangeReq->getDownId();
        $UpId = $TalkIngGroupResidentChangeReq->getUpId();
        return ['DownId'=>$DownId,'UpId'=>$UpId];

    }
}   