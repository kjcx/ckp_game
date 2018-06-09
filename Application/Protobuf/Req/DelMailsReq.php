<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/8
 * Time: 上午11:53
 */

namespace App\Protobuf\Req;

/**
 * 删除邮件请求
 * Class DelMailsReq
 * @package App\Protobuf\Req
 */
class DelMailsReq
{
    public static function decode($data)
    {
        $DelMailsReq = new \AutoMsg\DelMailsReq();
        $DelMailsReq->mergeFromString($data);
        $Ids = $DelMailsReq->getId()->getIterator();
        $arr = [];
        foreach ($Ids as $id) {
            $arr[] = $id;
        }
        return $arr;
    }
}