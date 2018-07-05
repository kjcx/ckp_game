<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/26
 * Time: 下午3:59
 */

namespace App\Protobuf\Result;

/**
 * npc状态
 * Class NpcInfo
 * @package App\Protobuf\Result
 */
class NpcInfo
{
    public static function encode($data)
    {
        $NpcInfo = new \AutoMsg\NpcInfo();
        $NpcId = $data['NpcId'];
        $Status = $data['Status'];
        $Appointed = $data['Appointed'];
        $NpcInfo->setNpcId($NpcId);
        $NpcInfo->setStatus($Status);
        $NpcInfo->setAppointed($Appointed);
        return $NpcInfo;
    }
}