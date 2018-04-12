<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/6
 * Time: 下午2:51
 */
namespace App\Protobuf\Req;
/** 移除道具请求
 * Class RemoveItemReq 1013
 * @package App\Protobuf\Req
 */
class RemoveItemReq
{
    public static function decode($data)
    {
        $RemoveItemReq = new \AutoMsg\RemoveItemReq();
        $RemoveItemReq->mergeFromString($data);
        $Count = $RemoveItemReq->getCount();//道具数量
        $ItemId = $RemoveItemReq->getItemId();//道具id
        return ['ItemId'=>$ItemId,'Count'=>$Count];
    }
}