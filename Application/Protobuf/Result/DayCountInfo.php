<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/4/19
 * Time: 上午11:32
 */
namespace App\Protobuf\Result;
use App\Models\Excel\GameEnum;

/**
 * 每日信息
 * Class DayCountInfo
 * @package App\Protobuf\Result
 */
class DayCountInfo
{
    public static function encode()
    {
        $DayCountInfo = new \AutoMsg\DayCountInfo();
        $GameEnum = new GameEnum();
        $gold  = $GameEnum->getDataCountType();
        $DayCountInfo->setGoldChangeCount($gold);
        return $DayCountInfo;
    }
}