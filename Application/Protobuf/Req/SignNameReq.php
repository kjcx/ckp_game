<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/7/5
 * Time: 上午10:07
 */

namespace App\Protobuf\Req;

/**
 * 修改签名
 * Class SignNameReq
 * @package App\Protobuf\Req
 */
class SignNameReq
{
    public static function decode($data)
    {
        $SignNameReq = new \AutoMsg\SignNameReq();
        $SignNameReq->mergeFromString($data);
        $Desc = $SignNameReq->getDesc();
        return ['Desc'=>$Desc];
    }
}