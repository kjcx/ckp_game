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
use App\Protobuf\Result\LoadBuildInfo;

class LandBuildInfo extends Model
{
    public static function encode($uid)
    {
        $Shop = new Shop();
        $data = $Shop->getAllShop($uid);
        $arr = [];
        if($data){
            foreach ($data as $datum) {
                $arr[] = LoadBuildInfo::encode($datum);
            }
        }
        return $arr;
    }
}