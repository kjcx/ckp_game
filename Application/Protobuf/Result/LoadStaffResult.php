<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 上午10:37
 */

namespace App\Protobuf\Result;
use App\Models\Staff\Staff;

/**
 * 返回所有员工
 * Class LoadStaffResult
 * @package App\Protobuf\Result
 */
class LoadStaffResult
{
    public static function encode($uid)
    {
        $LoadStaffResult = new \AutoMsg\LoadStaffResult();
        //通过uid查询用户店铺的员工
        $Staff = new Staff();
        $data = $Staff->getAllByUid($uid);
        if($data){
            $LoadRefStaffList = [];
            foreach ($data as $datum) {
                $LoadRefStaffList[] = LoadRefStaff::encode($datum);
            }

        }else{
            $LoadRefStaffList = [];
        }
        $LoadStaffResult->setLoadRefStaffList($LoadRefStaffList);
        $str = $LoadStaffResult->serializeToString();
        return $str;
    }
}