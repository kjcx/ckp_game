<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/26
 * Time: 下午7:34
 */

namespace App\Protobuf\Result;

/**
 * 返回居民委托任务 1134
 * Class ResidentDelegateResult
 * @package App\Protobuf\Result
 */
class ResidentDelegateResult
{
    public static function encode($data)
    {
        $ResidentDelegateResult = new \AutoMsg\ResidentDelegateResult();
        $Count = $data['Count'];
        $RefCount = $data['RefCount'];
        $NextTime = $data['NextTime'];
        $NpcTaskList = [];
        foreach ($data['NpcTask'] as $k=>$item) {
            $NpcTaskList[$k] = NpcTask::encode($item);
        }
        $ResidentDelegateResult->setCount($Count);
        $ResidentDelegateResult->setNpcTaskList($NpcTaskList);
        $ResidentDelegateResult->setRefCount($RefCount);
        $ResidentDelegateResult->setNextTime($NextTime);
        $str = $ResidentDelegateResult->serializeToString();
        return $str;
    }
}