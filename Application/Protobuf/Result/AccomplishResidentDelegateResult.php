<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/27
 * Time: 下午6:35
 */

namespace App\Protobuf\Result;

/**
 * 完成委托任务返回
 * Class AccomplishResidentDelegateResult
 * @package App\Protobuf\Result
 */
class AccomplishResidentDelegateResult
{
    public static function encode($data)
    {
        $AccomplishResidentDelegateResult = new \AutoMsg\AccomplishResidentDelegateResult();
        $AccomplishResidentDelegateResult->setSpot($data['Spot']);
        $NpcTask = NpcTask::encode($data['NpcTask']);
        $AccomplishResidentDelegateResult->setNpcTask($NpcTask);
        $str = $AccomplishResidentDelegateResult->serializeToString();
        return $str;
    }
}   