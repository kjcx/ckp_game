<?php
/**
 * Created by PhpStorm.
 * User: dupeng
 * Date: 2018/5/23
 * Time: 下午1:44
 */

namespace App\Protobuf\Result;


class RequestManorResult
{

    public static function decode()
    {
        
    }

    /**
     * 编码
     * $data['uid','time','name','manor' => []]
     *
     */
    public static function encode($data)
    {
        $obj = new \AutoMsg\RequestManorResult();
        $obj->setRoleId($data['uid']);
        $obj->setTime($data['time']);
        $manors = [];
        if (!empty($data['manor'])) {
            foreach ($data['manor'] as $value) {
                $manors[] = \App\Protobuf\Result\LoadManorData::encode($value);
            }
        }
        $obj->setLoadManor($manors);
        $obj->setUserName($data['name']);
        return $obj->serializeToString();
    }
}