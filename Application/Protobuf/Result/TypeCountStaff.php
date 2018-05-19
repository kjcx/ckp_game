<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/5/11
 * Time: 下午4:04
 */

namespace App\Protobuf\Result;

/**
 * 招聘抽奖次数时间建成
 * Class TypeCountStaff
 * @package App\Protobuf\Result
 */
class TypeCountStaff
{
    public static function encode($data)
    {
        $TypeCountStaff = new \AutoMsg\TypeCountStaff();
        $Count = (int)$data['Count'];
        $Date = (int)$data['Date'];
        $TypeCountStaff->setCount($Count);
        $TypeCountStaff->setDate($Date);
        return  $TypeCountStaff;
    }
}