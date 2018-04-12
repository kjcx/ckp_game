<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/10
 * Time: 下午4:30
 */
namespace App\Protobuf\Req;
/**
 * 购买时装请求
 * Class ModelClothesReq 1150
 * @package App\Protobuf\Req
 */
class ModelClothesReq
{
    public static function decode($data)
    {
        $ModelClothesReq = new \AutoMsg\ModelClothesReq();
        $ModelClothesReq->mergeFromString($data);
        $item = $ModelClothesReq->getId()->getIterator();
        $arr = [];
        foreach ($item as $id) {
            $arr[] = $id;
        }
        return $arr;
    }
}