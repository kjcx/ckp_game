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
    public static function encode($data,$Count)
    {
        $PkRankingResult = new \AutoMsg\PkRankingResult();
        $PkRankings = [];
        if($data){
            foreach ($data as $k=>$datum) {
                $PkRankings[$k] = PkRankingInfo::encode($datum);
            }
        }
        $PkRankingResult->setPkRanking($PkRankings);
        $PkRankingResult->setCount($Count);
        $str = $PkRankingResult->serializeToString();
        return $str;
    }
}