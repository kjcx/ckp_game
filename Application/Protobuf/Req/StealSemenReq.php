<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/6/8
 * Time: 下午2:01
 */

namespace App\Protobuf\Req;


class StealSemenReq
{
    public static function decode($string)
    {
        $data = [];
        $obj = new \AutoMsg\StealSemenReq();
        $obj->mergeFromString($string);

        $landIds = $obj->getId()->getIterator();
        $arr =[];
        foreach ($landIds as $landId) {
            $arr[] = $landId;
        }
        $data['uid'] = $obj->getUserId();
        $data['landIds'] = $arr;
        return $data;
    }
}