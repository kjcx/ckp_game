<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/12
 * Time: 下午2:36
 */

namespace App\Protobuf\Req;

/**
 * 调入调出员工
 * Class ComeOutEmployeeReq 1091
 * @package App\Protobuf\Req
 */
class ComeOutEmployeeReq
{
    public static function decode($data)
    {
        $ComeOutEmployeeReq = new \AutoMsg\ComeOutEmployeeReq();
        $ComeOutEmployeeReq->mergeFromString($data);
        $ShopId = $ComeOutEmployeeReq->getShopId();//店铺id
        $data_ComeOutEmployee = $ComeOutEmployeeReq->getNpcCardId()->getIterator();//员工id集合
        $NpcCardIds = [];
        foreach ($data_ComeOutEmployee as $NpcCardId) {
            $NpcCardIds[] = $NpcCardId;
        }
        $ComeOutInEmployee = $ComeOutEmployeeReq->getComeOutInEmployee();//调入还是调出
        return ['ShopId'=>$ShopId,'NpcCardId'=>$NpcCardIds,'ComeOutInEmployee'=>$ComeOutInEmployee];
    }
}