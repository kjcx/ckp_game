<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/27
 * Time: 下午3:15
 */

namespace App\Protobuf\Result;

/**
 * 添加好感度返回
 * Class AddNpcRelationAdvanceResult
 * @package App\Protobuf\Result
 */
class AddNpcRelationAdvanceResult
{
    public static function encode($data)
    {
        $AddNpcRelationAdvanceResult = new \AutoMsg\AddNpcRelationAdvanceResult();
        //查询当前
        $NpcFavorabilityFData = LoadNpcFavorability::encode($data);
        $AddNpcRelationAdvanceResult->setNpcFavorabilityFData($NpcFavorabilityFData);
        $str = $AddNpcRelationAdvanceResult->serializeToString();
        return $str;
    }
}