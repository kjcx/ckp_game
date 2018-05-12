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
        $TypeCountStaffResult = new \AutoMsg\TypeCountStaffResult();
        $TrainTime = time() + 3600;
        //返回当前人每个类型剩余次数
        $Lotto = new Lotto();
        $LottoLog = new LottoLog();
        $data = $Lotto->getAll();
        $TypeCountStaff = [];

        foreach ($data as  $datum) {
            $Type = $datum['Id'];
            $num = $LottoLog->getNumByUid($uid,$Type);
            $Count = $datum['Round'] - $num;//剩余次数
            $Time = $datum['Time'];//时间间隔
            $arr = ['Count'=>$Count,'Time'=>$Time];
            $TypeCountStaff[$Type] = TypeCountStaff::encode($arr);
        }

        $TypeCountStaffResult->setTrainTime($TrainTime);
        $TypeCountStaffResult->setTypeCountStaff($TypeCountStaff);
//        $str = $TypeCountStaffResult->serializeToString();
        return $TypeCountStaffResult;
    }
}