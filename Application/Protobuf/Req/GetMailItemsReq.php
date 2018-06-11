<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/8
 * Time: 上午11:56
 */

namespace App\Protobuf\Req;

/**
 * 获取邮件中的物品请求
 * Class GetMailItemsReq
 * @package App\Protobuf\Req
 */
class GetMailItemsReq
{
    public static function decode($data)
    {
        $GetMailItemsReq = new \AutoMsg\GetMailItemsReq();
        $GetMailItemsReq->mergeFromString($data);
        $Ids = $GetMailItemsReq->getId()->getIterator();
        $arr = [];
        foreach ($Ids as $id) {
            $arr[] = $id;
        }
        return $arr;
    }
}