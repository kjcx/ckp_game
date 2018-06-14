<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 下午3:41
 */

namespace App\Protobuf\Result;

use App\Models\Staff\LottoLog;

/**
 * 招聘抽奖
 * Class RefStaffResult
 * @package App\Protobuf\Result
 */
class RefStaffResult
{
    public static function encode($data_Staff)
    {
        $RefStaffResult = new \AutoMsg\RefStaffResult();
        $LoadRefStaff = [];
        foreach ($data_Staff as $item){
            var_dump($item);
            $LoadRefStaff[] = LoadRefStaff::encode($item);
        }

        $RefStaffResult->setLoadRefStaffList($LoadRefStaff);

        $LottoLog = new LottoLog();
        $data = $LottoLog->getTypeCountStaff($data_Staff[0]['Uid']);//查询免费抽奖次数和数据
        $TypeCountStaff = [];
        foreach ($data as $k =>$datum) {
            $TypeCountStaff[$k] = TypeCountStaff::encode($datum);
        }
        $RefStaffResult->setTypeCountStaff($TypeCountStaff);
        $str = $RefStaffResult->serializeToString();
        return $str;
    }
}