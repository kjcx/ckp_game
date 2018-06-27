<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/27
 * Time: 上午11:09
 */

namespace App\Protobuf\Result;

/**
 * 居民npc数据
 * Class LoadNpcFavorability
 * @package App\Protobuf\Result
 */
class LoadNpcFavorability
{
    public static function encode($data)
    {
        $LoadNpcFavorability = new \AutoMsg\LoadNpcFavorability();
        $LoadNpcFavorability->setNpcId($data['NpcId']);
        $LoadNpcFavorability->setCurrentFavorability($data['CurrentFavorability']);//CurrentFavorability
        $LoadNpcFavorability->setFavorabilityLevel($data['FavorabilityLevel']);//品质
        $LoadNpcFavorability->setStatus($data['Status']);//解锁状态
        return $LoadNpcFavorability;
    }
}