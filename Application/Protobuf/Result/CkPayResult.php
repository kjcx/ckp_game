<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/19
 * Time: 下午1:23
 */
namespace App\Protobuf\Result;
/**
 * 充值返回结果
 * Class CkPayResult 1224
 * @package App\Protobuf\Result
 */
class CkPayResult
{
    /**
     * @param $bool 1 成功 0 失败
     * @return string
     */
    public static function encode($bool)
    {
        $CkPayResult = new \AutoMsg\CkPayResult();
        $CkPayResult->setStatus($bool);
        $str = $CkPayResult->serializeToString();
        return $str;
    }
}