<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/6
 * Time: 下午3:14
 */
namespace App\Protobuf\Req;
/**
 * 道具购买
 * Class ItemBuyReq 1028
 * @package App\Protobuf\Req
 */
class ItemBuyReq
{
    public function decode($data)
    {
        $ItemBuyReq = new \AutoMsg\ItemBuyReq();
        $ItemBuyReq->serializeToString($data);
        $ItemId = $ItemBuyReq->getItemId();
        $Count = $ItemBuyReq->getCount();
        return ['ItemId'=>$ItemId,'Count'=>$Count];
    }
}