<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/6
 * Time: 下午2:59
 */
namespace App\Protobuf\Req;
/**
 * 出售道具
 * Class SellItemReq 1014
 * @package App\Protobuf\Req
 */
class SellItemReq
{
    public function decode($data)
    {
        $SellItemReq = new \AutoMsg\SellItemReq();
        $SellItemReq->mergeFromString($data);
        $ItemId = $SellItemReq->getItemId();//道具id
        $Count = $SellItemReq->getCount();//道具数量
        return ['ItemId'=>$ItemId,'Count'=>$Count];
    }
}