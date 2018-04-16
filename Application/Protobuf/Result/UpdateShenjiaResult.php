<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/7
 * Time: 上午12:49
 */
namespace App\Protobuf\Result;
/**
 * 身价值变换
 * Class UpdateShenjiaResult 1075
 * @package App\Protobuf\Result
 */
class UpdateShenjiaResult
{
    public static function encode($shenjia)
    {
        $UpdateShenjiaResult = new \AutoMsg\UpdateShenjiaResult();
        $UpdateShenjiaResult->setSocialStatus($shenjia);
        $str = $UpdateShenjiaResult->serializeToString();
        return $str;
    }
}