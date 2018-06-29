<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/28
 * Time: 下午8:11
 */

namespace App\Protobuf\Req;

/**
 * 谈判团任命请求
 * Class TalkingGroupReq
 * @package App\Protobuf\Req
 */
class TalkingGroupReq
{
    public static function decode($data)
    {
        $TalkingGroupReq = new \AutoMsg\TalkingGroupReq();
        $TalkingGroupReq->mergeFromString($data);
        $Ids = $TalkingGroupReq->getIds()->getIterator();
        $StaffId = [];
        foreach ($Ids as $id) {
            $StaffId[] = $id;
        }
        $Replace = $TalkingGroupReq->getReplace();
        return ['StaffId'=>$StaffId,'Replace'=>$Replace];
    }
}