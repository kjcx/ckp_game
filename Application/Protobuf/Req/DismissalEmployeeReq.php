<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/13
 * Time: 下午7:11
 */

namespace App\Protobuf\Req;

/**
 * 解雇员工
 * Class DismissalEmployeeReq
 * @package App\Protobuf\Req
 */
class DismissalEmployeeReq
{
    public static function decode($data)
    {
        $DismissalEmployeeReq = new \AutoMsg\DismissalEmployeeReq();
        $DismissalEmployeeReq->mergeFromString($data);
        $ListIds = $DismissalEmployeeReq->getListId()->getIterator();
        $arr = [];
        foreach ($ListIds as $listId) {
            $arr[] = $listId;
        }
        return $arr;
    }
}