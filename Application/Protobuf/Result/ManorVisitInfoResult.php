<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/23
 * Time: 下午3:20
 */

namespace App\Protobuf\Result;


class ManorVisitInfoResult
{
    public static function encode($data)
    {
        $visits = [];
        $obj = new \AutoMsg\ManorVisitInfoResult();
        if (!empty($data)) {
            foreach ($data as $value) {
                $visits[] = ManorVisitInfoRes::encode($value);
            }
        }
        $obj->setVisits($visits);
        return $obj->serializeToString();
    }
}