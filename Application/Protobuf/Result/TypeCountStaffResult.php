<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 下午3:48
 */

namespace App\Protobuf\Result;


use App\Models\Execl\Lotto;
use App\Models\Staff\LottoLog;

class TypeCountStaffResult
{
    public static function encode($uid)
    {
        $LottoLog = new LottoLog();
        $data_TypeCountStaff = $LottoLog->getTypeCountStaff($uid);
        $TypeCountStaff = [];
        foreach ($data_TypeCountStaff as $k=> $datum) {
            $TypeCountStaff[$k] = TypeCountStaff::encode($datum);
        }
        $TypeCountStaffResult = new \AutoMsg\TypeCountStaffResult();
        $TypeCountStaffResult->setTypeCountStaff($TypeCountStaff);
        return $TypeCountStaffResult;
    }
}