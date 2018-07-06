<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/7/5
 * Time: 下午3:10
 */

namespace App\Protobuf\Req;

/**
 * 谈判团居民任职请求
 * Class TalkingGroupResidentReq
 * @package App\Protobuf\Req
 */
class TalkingGroupResidentReq
{
    public static function decode($data)
    {
        $TalkingGroupResidentReq = new \AutoMsg\TalkingGroupResidentReq();
        $TalkingGroupResidentReq->mergeFromString($data);
        $Ids = $TalkingGroupResidentReq->getIds()->getIterator();
        $Replace = $TalkingGroupResidentReq->getReplace();
        $new = [];
        foreach ($Ids as $id) {
            $new[] = $id;
        }
        return ['Ids'=>$new,'Replace'=>$Replace];
    }
}