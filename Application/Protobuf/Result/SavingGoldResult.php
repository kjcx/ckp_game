<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/4
 * Time: 上午11:32
 */

namespace App\Protobuf\Result;

use App\Models\Bank\SavingGold;

/**
 * 存款返回
 * Class SavingGoldResult 1047
 * @package App\Protobuf\Result
 */
class SavingGoldResult
{
    public static function encode($Id)
    {
        $SavingGoldResult = new \AutoMsg\SavingGoldResult();
        $SavingGold = new SavingGold();
        $data = $SavingGold->getInofById($Id);
        $SavingInfo = SavingInfo::ecode($data);
        $SavingGoldResult->setSavingInfo($SavingInfo);
        $str = $SavingGoldResult->serializeToString();
        return $str;
    }

}