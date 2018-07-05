<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/7/5
 * Time: 上午10:08
 */

namespace App\Protobuf\Result;

/**
 * 修改个性签名返回
 * Class SignNameResult
 * @package App\Protobuf\Result
 */
class SignNameResult
{
    public static function encode($Desc)
    {
        $SignNameResult = new \AutoMsg\SignNameResult();
        $SignNameResult->setDesc($Desc);
        $str = $SignNameResult->serializeToString();
        return $str;
    }
}