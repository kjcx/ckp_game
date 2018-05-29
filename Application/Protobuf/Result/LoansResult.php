<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/23
 * Time: 下午5:05
 */

namespace App\Protobuf\Result;

/**
 * 贷款返回
 * Class LoansResult
 * @package App\Protobuf\Result
 */
class LoansResult
{
    public static function encode($Id)
    {
        $LoansResult = new \AutoMsg\LoansResult();
        $LoansInfo = new \App\Models\Bank\LoansInfo();
        $data = $LoansInfo->getInfoById($Id);
        $LoansInfo = LoansInfo::encode($data);
        $LoansResult->setLoans($LoansInfo);
        $str = $LoansResult->serializeToString();
        return $str;
    }
}