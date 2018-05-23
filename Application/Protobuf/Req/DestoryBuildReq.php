<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/14
 * Time: 下午2:53
 */

namespace App\Protobuf\Req;

/**
 * 出售店铺
 * Class DestoryBuildReq 1010
 * @package App\Protobuf\Req
 */
class DestoryBuildReq
{
    public static function decode($data)
    {
        $DestoryBuildReq = new \AutoMsg\DestoryBuildReq();
        $DestoryBuildReq->mergeFromString($data);
        $Id = $DestoryBuildReq->getId();
        return ['Id'=>$Id];
    }
}