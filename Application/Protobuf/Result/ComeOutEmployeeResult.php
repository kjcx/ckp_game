<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/12
 * Time: 下午3:08
 */

namespace App\Protobuf\Result;
use App\Models\Staff\Staff;

/**
 * 调入调出员工
 * Class ComeOutEmployeeResult 1126
 * @package App\Protobuf\Result
 */
class ComeOutEmployeeResult
{
    public static function encode($data)
    {
        $ShopId = $data['ShopId'];
        $ComeOutEmployeeResult = new \AutoMsg\ComeOutEmployeeResult();
        //1查询店铺员工数量
        $Staff = new Staff();
        $ShopStaffCount = $Staff->getShopStaffCountByShopId($ShopId);
        $ComeOutEmployeeResult->setBuildShopId($ShopId);//店铺id
        $ComeOutEmployeeResult->setBuildShopStaffCount($ShopStaffCount);//店铺员工数量
        $data_Staff = $Staff->getShopStaffByNpcIds($data['NpcCardId']);
//        var_dump("ShopStaffCount:" . $ShopStaffCount);
//        var_dump($data_Staff);
        $StaffData = [];
        foreach ($data_Staff as $item) {
            $StaffData[] = LoadRefStaff::encode($item);
        }
        $ComeOutEmployeeResult->setStaffData($StaffData);//店铺员工数据
        $str = $ComeOutEmployeeResult->serializeToString();
        return $str;
    }
}