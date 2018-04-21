<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/20
 * Time: 上午11:46
 */
namespace App\Protobuf\Req;
/**
 * 金币兑换创客币
 * Class MoneyChangeReq 1079
 * @package App\Protobuf\Req
 */
class MoneyChangeReq
{
    public static function decode($data)
    {
        $MoneyChangeReq = new \AutoMsg\MoneyChangeReq();
        $MoneyChangeReq->mergeFromString($data);
        $ChangeTo = $MoneyChangeReq->getChangeTo();
        $Count = $MoneyChangeReq->getCount();
        return ['ChangeTo'=>$ChangeTo,'Count'=>$Count];
    }
}