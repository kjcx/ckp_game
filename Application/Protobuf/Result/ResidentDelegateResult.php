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
        $ItemList = $data['ItemList'];
        $Count = $data['Count'];
        $RefCount = $data['RefCount'];
        $Item = ItemList::encode($ItemList);
        $ResidentDelegateResult->setCount($Count);
        $ResidentDelegateResult->setItemCount($Item);
        $ResidentDelegateResult->setRefCount($RefCount);
        $str = $ResidentDelegateResult->serializeToString();
        return $str;
    }
}