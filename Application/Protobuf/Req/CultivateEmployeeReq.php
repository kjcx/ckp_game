<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/19
 * Time: 下午4:20
 */

namespace App\Protobuf\Req;

/**
 * 请求培训
 * Class CultivateEmployeeReq 1086
 * @package App\Protobuf\Req
 */
class CultivateEmployeeReq
{
    public static function decode($data)
    {
        $CultivateEmployeeReq = new \AutoMsg\CultivateEmployeeReq();
        $CultivateEmployeeReq->mergeFromString($data);
        $ListIds = $CultivateEmployeeReq->getListId()->getIterator();
        $arr = [];
        foreach ($ListIds as $listId) {
            $arr[] = $listId;
        }
        return $arr;
    }
}