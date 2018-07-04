<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/7/3
 * Time: 下午5:03
 */

namespace App\Protobuf\Result;

/**
 * pk排行榜返回
 * Class PkRankingResult
 * @package App\Protobuf\Result
 */
class PkRankingResult
{
    public static function encode($data)
    {
        var_dump($data);
        $PkRankingResult = new \AutoMsg\PkRankingResult();
        $PkRankings = [];
        if($PkRankings){
            foreach ($data as $datum) {
                $PkRankings[] = PkRankingInfo::encode($datum);
            }
        }
        $PkRankingResult->setPkRanking($PkRankings);
        $str = $PkRankingResult->serializeToString();
        return $str;
    }
}