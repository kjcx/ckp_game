<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/10
 * Time: 下午6:42
 */

namespace App\Protobuf\Result;


use App\Models\Company\CreateBuild;

/**
 * 获得店铺信息
 * Class GetMapResult
 * @package App\Protobuf\Result
 */
class GetMapResult
{
    public static function encode($uid)
    {
        $GetMapResult = new \AutoMsg\GetMapResult();
        $CreateBuild = new CreateBuild();
        $data = $CreateBuild->getAllShop($uid);
        $arr = [];
        if($data){
            foreach ($data as $datum) {
                var_dump($datum);
                $arr[] = LoadBuildInfo::encode($datum);
            }
        }

        $GetMapResult->setLoadBuildInfo($arr);
//        $str = $GetMapResult->serializeToString();
        return $GetMapResult;
    }
}