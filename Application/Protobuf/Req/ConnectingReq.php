<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/5
 * Time: 下午12:07
 */
namespace App\Protobuf\Req;

/**
 * Class ConnectingReq 1004
 * @package App\Protobuf\Result
 */
class ConnectingReq
{
    /**
     * 解析数据
     * @param $data
     * @return string
     */
    public static function decode($data)
    {
        $ConnectingReq = new \AutoMsg\ConnectingReq();
        $ConnectingReq->mergeFromString($data);
        $token = $ConnectingReq->getToken();
        return $token;
    }
}
