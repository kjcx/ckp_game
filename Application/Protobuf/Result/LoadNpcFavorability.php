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
        if($data){
            $LoadNpcFavorability->setNpcId((int)$data['NpcId']);
            $LoadNpcFavorability->setCurrentFavorability((int)$data['CurrentFavorability']);//CurrentFavorability
            $LoadNpcFavorability->setFavorabilityLevel((int)$data['FavorabilityLevel']);//品质
            $LoadNpcFavorability->setStatus($data['Status']);//解锁状态
            $LoadNpcFavorability->setAppointed($data['Appointed']);//是否任职
        }
        return $LoadNpcFavorability;
    }
}