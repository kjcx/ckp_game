<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/19
 * Time: 下午4:22
 */

namespace App\Protobuf\Result;

use App\Models\Staff\Staff;

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
        $Staff = new Staff();
        $data_Staff = $Staff->getInfoByIds($data);
        var_dump($data_Staff);
        foreach ($data_Staff as $staff) {
            $StaffList[] = LoadRefStaff::encode($staff);
        }
        $CultivateEmployeeResult->setCultivateStaffList($StaffList);
//        $CultivateEmployeeResult->setTrainTime();
        $str = $CultivateEmployeeResult->serializeToString();
        return $str;
    }
}