<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/19
 * Time: 下午4:22
 */

namespace App\Protobuf\Result;

/**
 * 培训返回
 * Class CultivateEmployeeResult 1121
 * @package App\Protobuf\Result
 */
class CultivateEmployeeResult
{
    public static function encode($data)
    {
        $CultivateEmployeeResult = new \AutoMsg\CultivateEmployeeResult();
        $CultivateEmployeeResult->setCultivateStaffList();
        $CultivateEmployeeResult->setTrainTime();
        $str = $CultivateEmployeeResult->serializeToString();
        return $str;
    }
}