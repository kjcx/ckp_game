<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/23
 * Time: 下午3:13
 */

namespace App\Protobuf\Result;


class LoadManorData
{

    public static function encode($value)
    {
        $manor = new \AutoMsg\LoadManorData();
        if (!empty($value)) {
            $manor->setId($value['Id']);
            $manor->setPlantDate($value['PlantDate']);
            $manor->setSemenId($value['SemenId']);
            $manor->setStatusTime($value['StatusTime']);
            $manor->setStatus($value['Status']);
            $manor->setPhasesStatus($value['PhasesStatus']);
            $manor->setStealTime($value['StealTime']);
            $manor->setSoilState($value['SoilState']);
            $manor->setUserName($value['UserName']);
            $manor->setSoilLevel($value['SoilLevel']);
        }
        return $manor;
    }
}