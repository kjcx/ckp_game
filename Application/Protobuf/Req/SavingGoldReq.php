<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/4
 * Time: 上午11:28
 */

namespace App\Protobuf\Req;

/**
 * 存款请求
 * Class SavingGoldReq 1047
 * @package App\Protobuf\Req
 */
class SavingGoldReq
{
    public static function decode($data)
    {
        $SavingGoldReq = new \AutoMsg\SavingGoldReq();
        $SavingGoldReq->mergeFromString($data);
        $GoldType = $SavingGoldReq->getGoldType();
        $GoldCount = $SavingGoldReq->getGoldCount();
        $SaveType = $SavingGoldReq->getSaveType();
        $TimeLimit = $SavingGoldReq->getTimeLimit();
        return ['GoldType'=>$GoldType,'GoldCount'=>$GoldCount,'SaveType'=>$SaveType,'TimeLimit'=>$TimeLimit];
    }
}