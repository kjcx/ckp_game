<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/12
 * Time: 下午7:01
 */

namespace App\Models\LoadData;


use App\Models\Company\Shop;
use App\Models\Model;
use App\Models\Staff\Staff;
use App\Protobuf\Result\LoadBuildInfo;

class LandBuildInfo extends Model
{
    public static function encode($uid,$Area=2)
    {
        $Shop = new Shop();
        $Staff = new Staff();
        $data = $Shop->getAllShop($uid,$Area);
        $arr = [];
        if($data){
            foreach ($data as $datum) {
                $count = $Staff->getShopEmployee($datum['_id']);
                $datum['Employee'] = $count;
                $arr[] = LoadBuildInfo::encode($datum);
            }
        }
        return $arr;
    }

    /**
     * 获取一条记录
     * @param $ShopId
     * @return array|\AutoMsg\LoadBuildInfo
     */
    public static function getOne($ShopId)
    {
        $Shop = new Shop();
        $Staff = new Staff();
        $data = $Shop->getInfoById($ShopId);

        $arr = [];
        $count = $Staff->getShopEmployee($data['_id']);
        $data['Employee'] = $count;
        $arr[] = LoadBuildInfo::encode($data);
        return $arr;
    }
}