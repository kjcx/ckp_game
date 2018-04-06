<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/6
 * Time: 下午3:02
 */
namespace App\Protobuf\Req;
/**
 * 使用道具
 * Class UseItemReq
 * @package App\Protobuf\Req
 */
class UseItemReq
{
    public static function decode($data)
    {
        $UseItemReq = new \AutoMsg\UseItemReq();
        $UseItemReq->mergeFromString($data);
        $ItemId = $UseItemReq->getItemId();
        $Count = $UseItemReq->getCount();
        return ['ItemId'=>$ItemId,'Count'=>$Count];
    }

}