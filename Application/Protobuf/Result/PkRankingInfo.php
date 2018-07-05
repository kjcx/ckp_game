<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/7/3
 * Time: 下午5:05
 */

namespace App\Protobuf\Result;

/**
 *
 * Class PkRankingInfo
 * @package App\Protobuf\Result
 */
class PkRankingInfo
{
    public static function encode($data)
    {
        var_dump('Ranking');
        var_dump($data['Ranking']);
        $PkRankingInfo = new \AutoMsg\PkRankingInfo();
        $PkRankingInfo->setRanking($data['Ranking']);
        $PkRankingInfo->setName($data['Name']);
        $PkRankingInfo->setScore($data['Score']);
        $PkRankingInfo->setShenjiazhi($data['Shenjiazhi']);
        return $PkRankingInfo;
    }
}