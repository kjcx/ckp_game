<?php
/**
 * Created by PhpStorm.
 * User: dongkai
 * Date: 2018/6/27
 * Time: 下午2:49
 */

namespace App\Protobuf\Result;

/**
 * 返回npc
 * Class NpcTask
 * @package App\Protobuf\Result
 */
class NpcTask
{
    public static function encode($data)
    {
        $NpcTask = new \AutoMsg\NpcTask();
        $NpcTask->setNpcId($data['NpcId']);
        $NpcTask->setTaskId($data['TaskId']);
        return $NpcTask;
    }
}