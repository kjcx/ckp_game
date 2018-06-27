<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/27
 * Time: 上午11:08
 */

namespace App\Protobuf\Result;

/**
 * 返回npc好感度
 * Class NpcFavorabilityResult
 * @package App\Protobuf\Result
 */
class NpcFavorabilityResult
{
    public static function encode($data)
    {
        $NpcFavorabilityResult = new \AutoMsg\NpcFavorabilityResult();
        $LoadNpcFavorability = [];
        foreach ($data as $datum) {
            $LoadNpcFavorability[] = LoadNpcFavorability::encode($datum);
        }
        $NpcFavorabilityResult->setNpcFavorabilityData($LoadNpcFavorability);
        $str = $NpcFavorabilityResult->serializeToString();
        return $str;
    }
}