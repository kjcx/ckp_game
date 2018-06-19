<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/19
 * Time: 上午11:36
 */

namespace App\Protobuf\Result;

/**
 * 签到信息列表
 * Class LoadSignInfoList
 * @package App\Protobuf\Result
 */
class LoadSignInfoList
{
    public static function encode($data)
    {
        $LoadSignInfoList = new \AutoMsg\LoadSignInfoList();
        $LoadSignList = [];
        foreach ($data as $datum) {
            $LoadSignList[]  =LoadSignInfo::ecode($datum);
        }
        $LoadSignInfoList->setLoadSignList($LoadSignList);
        return $LoadSignInfoList;
    }
}