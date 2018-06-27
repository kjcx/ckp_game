<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/27
 * Time: 下午4:29
 */

namespace App\Protobuf\Req;

/**
 * 请求完成委托任务
 * Class AccomplishResidentDelegateReq
 * @package App\Protobuf\Req
 */
class AccomplishResidentDelegateReq
{
    public static function decode($data)
    {
        $AccomplishResidentDelegateReq = new \AutoMsg\AccomplishResidentDelegateReq();
        $TaskId = $AccomplishResidentDelegateReq->getArrayId()
        return ['TaskId'=>$TaskId];
    }
}