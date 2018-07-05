<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/7/4
 * Time: 下午4:02
 */

namespace App\Protobuf\Result;


class GetRankingResult
{
    /**
     * @param $data
     * @return string
     */
    public static function encode($data)
    {
        $obj = new \AutoMsg\GetRankingResult();
        $obj->setIncomeRanking(1);
        $obj->setCompanyRanking(2);
        $obj->setGoldCountRanking(3);
        $obj->setFeelingRanking(4);
        $obj->setPKWin(5);
        $obj->setPKWinCount(6);
        $obj->setPKLostCount(7);
        $obj->setPKPingCount(8);
        return $obj->serializeToString();
    }
}