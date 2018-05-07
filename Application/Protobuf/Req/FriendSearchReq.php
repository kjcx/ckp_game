<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/28
 * Time: 下午2:04
 */

namespace App\Protobuf\Req;

/**
 * 搜索好友
 * Class FriendSearchReq 1024
 * @package App\Protobuf\Req
 */
class FriendSearchReq
{
    public static function decode($data)
    {
        $FriendSearchReq = new \AutoMsg\FriendSearchReq();
        $FriendSearchReq->mergeFromString($data);
        $Name = $FriendSearchReq->getName();
        $Search = $FriendSearchReq->getSearch();
        return ['Name'=>$Name, 'Search'=>$Search];
    }
}